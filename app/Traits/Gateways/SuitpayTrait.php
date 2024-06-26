<?php

namespace App\Traits\Gateways;

use App\Models\AffiliateHistory;
use App\Models\Deposit;
use App\Models\SuitPayPayment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\NewDepositNotification;
use App\Notifications\NewWithdrawalNotification;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

trait SuitpayTrait
{
    /**
     * @var $uri
     * @var $clienteId
     * @var $clienteSecret
     */
    protected static string $uri;
    protected static string $clienteId;
    protected static string $clienteSecret;

    /**
     * Generate Credentials
     * Metodo para gerar credenciais
     * @return void
     */
    private static function generateCredentials()
    {
        $setting = \Helper::getSetting();
        if(!empty($setting)) {
            self::$uri = $setting->suitpay_uri;
            self::$clienteId = $setting->suitpay_cliente_id;
            self::$clienteSecret = $setting->suitpay_cliente_secret;
        }
    }

    /**
     * Request QRCODE
     * Metodo para solicitar uma QRCODE PIX
     * @return array
     */
    public static function requestQrcode($request)
    {
        $setting = \Helper::getSetting();
        $rules = [
            'amount' => ['required', 'max:'.$setting->min_deposit, 'max:'.$setting->max_deposit],
            'cpf'    => ['required', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        self::generateCredentials();


        $sec_token = Str::random(40);
        // $test_callback = 'https://8070-167-250-139-77.ngrok-free.app/suitpay/callback?sec_token='.$sec_token;
        $callback_prod = url('/suitpay/callback?sec_token='.$sec_token);

        $response = Http::withHeaders([
            'ci' => self::$clienteId,
            'cs' => self::$clienteSecret
        ])->post(self::$uri.'gateway/request-qrcode', [
            "requestNumber" => time(),
            "dueDate" => Carbon::now()->addDay(),
            "amount" => \Helper::amountPrepare($request->amount),
            "shippingAmount" => 0.0,
            "usernameCheckout" => "checkout",
            "callbackUrl" => $callback_prod,
            "client" => [
                "name" => auth()->user()->name,
                "document" => \Helper::soNumero($request->cpf),
                "phoneNumber" => \Helper::soNumero(auth()->user()->phone),
                "email" => auth()->user()->email
            ]
        ]);

        if($response->successful()) {
            $responseData = $response->json();

            self::generateTransaction($responseData['idTransaction'], \Helper::amountPrepare($request->amount), $sec_token);
            self::generateDeposit($responseData['idTransaction'], \Helper::amountPrepare($request->amount));

            return [
                'status' => true,
                'idTransaction' => $responseData['idTransaction'],
                'qrcode' => $responseData['paymentCode']
            ];
        }

        return [
            'status' => false,
        ];
    }

    /**
     * Consult Status Transaction
     * Consultar o status da transação
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function consultStatusTransaction($request)
    {

        $transaction = Transaction::where('payment_id', $request->idTransaction)->first();

        if($transaction->status > 0) {
            return response()->json(['status' => 'PAID']);
        } else {
            return response()->json(['status' => 'WAITING_PAYMENT'], 400);
        }
    }

    /**
     * @param $idTransaction
     * @return bool
     */
    public static function finalizePayment($idTransaction): bool
    {
        $transaction = Transaction::where('payment_id', $idTransaction)->where('status', 0)->first();
        $setting = \Helper::getSetting();

        if(!empty($transaction)) {
            $user = User::find($transaction->user_id);

            /// verifica se vem de um convite
            if(!empty($user) && !empty($user->inviter)) {
                $afiliado =  User::find($user->inviter);
                if(!empty($afiliado)) {
                    // TODO:
                }
            }

            $wallet = Wallet::where('user_id', $transaction->user_id)->first();
            if(!empty($wallet)) {
                $checkTransactions = Transaction::where('user_id', $transaction->user_id)->count();
                if($checkTransactions <= 1) {
                    // First deposit Bonus
                    $bonus = \Helper::porcentagem_xn($setting->initial_bonus, $transaction->price);
                    $wallet->increment('balance_bonus', $bonus);
                }

                if($wallet->increment('balance', $transaction->price)) {


                    if($transaction->update(['status' => 1])) {
                        $deposit = Deposit::where('payment_id', $idTransaction)->where('status', 0)->lockForUpdate()->first();
                        if(!empty($deposit)) {

                            $affHistories = AffiliateHistory::where('user_id', $transaction->user_id)
                                ->where('deposited', 0)
                                ->where('status', 0)
                                ->lockForUpdate()
                                ->get();

                            foreach($affHistories as $affHistory) {
                                if(!empty($affHistory)) {
                                    $affHistory->update(['deposited' => 1, 'deposited_amount' => $transaction->price]);
                                }
                            }

                            // send CPA to Affiliate
                            $affHistoryCPA = AffiliateHistory::where('user_id', $transaction->user_id)
                                ->where('commission_type', 'cpa')
                                ->where('deposited', 1)
                                ->where('status', 0)
                                ->lockForUpdate()
                                ->first();

                            if(!empty($affHistoryCPA)) {

                                /// verifica se já pode receber o cpa
                                $sponsorCpa = User::find($affHistoryCPA->inviter);
                                if(!empty($sponsorCpa)) {
                                    // TODO: add this to the user settings, and a default
                                    if($affHistoryCPA->deposited_amount > $sponsorCpa->affiliate_baseline) {
                                        $walletCpa = Wallet::where('user_id', $affHistoryCPA->inviter)->lockForUpdate()->first();
                                        if(!empty($walletCpa)) {

                                            /// paga o valor de CPA
                                            $walletCpa->increment('refer_rewards', $sponsorCpa->affiliate_cpa); /// coloca a comissão
                                            $affHistoryCPA->update(['status' => 1, 'commission_paid' => $sponsorCpa->affiliate_cpa]); /// desativa cpa
                                        }
                                    }
                                }
                            }

                            if($deposit->update(['status' => 1])) {
                                $admins = User::where('role_id', 0)->get();
                                foreach ($admins as $admin) {
                                    $admin->notify(new NewDepositNotification($user->name, $transaction->price));
                                }

                                return true;
                            }
                            return false;
                        }
                        return false;
                    }
                    return false;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    /**
     * @param $idTransaction
     * @param $amount
     * @return void
     */
    private static function generateDeposit($idTransaction, $amount)
    {
        Deposit::create([
            'payment_id' => $idTransaction,
            'user_id' => auth()->user()->id,
            'amount' => $amount,
            'type' => 'Pix',
            'status' => 0
        ]);
    }

    /**
     * @param $idTransaction
     * @param $amount
     * @return void
     */
    private static function generateTransaction($idTransaction, $amount, $sec_token)
    {
        $setting = \Helper::getSetting();

        Transaction::create([
            'payment_id' => $idTransaction,
            'user_id' => auth()->user()->id,
            'payment_method' => 'pix',
            'price' => $amount,
            'currency' => $setting->currency_code,
            'status' => 0,
            'sec_token' => $sec_token
        ]);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public static function pixCashOut(array $array)
    {
        self::generateCredentials();

        $response = Http::withHeaders([
            'ci' => self::$clienteId,
            'cs' => self::$clienteSecret
        ])->post(self::$uri.'gateway/pix-payment', [
            "key" => $array['pix_key'],
            "typeKey" => $array['pix_type'],
            "value" => $array['amount'],
            'callbackUrl' => url('/suitpay/payment'),
            ]);

        Log::info(['pixCashOut' => $response->json()]);

        $responseData = $response->json();

        if($responseData['response'] == 'OK') {
            $suitPayPayment = SuitPayPayment::lockForUpdate()->find($array['suitpayment_id']);
            if(!empty($suitPayPayment)) {
                if($suitPayPayment->update(['status' => 1, 'payment_id' => $responseData['idTransaction']])) {
                    return ['status' => true, 'message' => 'Pagamento efetuado com sucesso'];
                }
            }
        }

        if($responseData['response'] == 'PIX_KEY_NOT_FOUND') {
            return ['status' => false, 'message' => 'Chave Pix não encontrada'];
        }

        if($responseData['response'] == 'ACCOUNT_DOCUMENTS_NOT_VALIDATED') {
            return ['status' => false, 'message' => 'Conta SuitPay não validada'];
        }

        if($responseData['response'] == 'DOCUMENT_VALIDATE') {
            return ['status' => false, 'message' => 'Chave Pix não pertence ao titular da conta'];
        }

        if($responseData['response'] == 'NO_FUNDS') {
            return ['status' => false, 'message' => 'Saldo SuitPay Insuficiente.'];
        }

        if($responseData['response'] == 'UNAUTHORIZED_IP') {
            return ['status' => false, 'message' => 'IP não autorizado'];
        }

        if($responseData['response'] == 'ERROR') {
            return ['status' => false, 'message' => 'Erro interno SuitPay'];
        }

        return ['status' => false, 'message' => 'Erro ao efetuar pagamento'];
    }
}
