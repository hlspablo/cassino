<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Models\SuitPayPayment;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\User;
use App\Traits\Gateways\SuitpayTrait;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuitPayController extends Controller
{
    use SuitpayTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function callbackMethod(Request $request)
    {
        $data = $request->all();
        $realIp = $request->ip();

        $allowedIps = ['162.243.162.250', '192.34.62.86',
            '137.184.60.127','159.223.100.252',
            '157.245.93.131', '208.68.39.149'];

        if(!in_array($realIp, $allowedIps)) {
            return response()->json([], 403);
        }

        $sec_token = $request->query('sec_token');

        $transaction = Transaction::where('payment_id', $data['idTransaction'])->first();

        if(empty($transaction) || $transaction->sec_token != $sec_token) {
            return response()->json([], 404);
        }

        if(isset($data['idTransaction']) && $data['typeTransaction'] == 'PIX') {
            if($data['statusTransaction'] == "PAID_OUT" || $data['statusTransaction'] == "PAYMENT_ACCEPT") {
                if(self::finalizePayment($data['idTransaction'])) {
                    return response()->json([], 200);
                }
            }
        }
    }

    /**
     * @param Request $request
     * @return null
     */
    public function getQRCodePix(Request $request)
    {
        if(auth()->user()->is_demo_agent) {
            auth()->user()->wallet->increment('balance', $request->amount);
            return response()->json(['status' => 'CLOSE']);
        } else {
            return self::requestQrcode($request);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function consultStatusTransactionPix(Request $request)
    {
        return self::consultStatusTransaction($request);
    }

    public function undoWithdrawal($id)
    {
        if(auth()->user()->hasRole('admin')) {

            $withdrawal = Withdrawal::find($id);
            if(!empty($withdrawal)) {

                $user = User::where('id', $withdrawal->user_id)->first();
                if($user) {
                    $user->wallet->increment('balance', $withdrawal->amount);
                    $withdrawal->update(['status' => 2]);
                    Notification::make()
                        ->title('Saque devolvido')
                        ->body('Saque devolvido com sucesso')
                        ->success()
                        ->send();
                }

                return back();
            }
        }
    }

    // Confirmar Saque (Painel Admin)
    public function withdrawalFromModal($id)
    {
        if(auth()->user()->hasRole('admin')) {
            $withdrawal = Withdrawal::find($id);
            if(!empty($withdrawal)) {
                $suitpayment = SuitPayPayment::create([
                    'withdrawal_id' => $withdrawal->id,
                    'user_id'       => $withdrawal->user_id,
                    'pix_key'       => $withdrawal->chave_pix,
                    'pix_type'      => $withdrawal->tipo_chave,
                    'amount'        => $withdrawal->amount,
                    'observation'   => 'Saque direto',
                ]);

                if($suitpayment) {
                    $parm = [
                        'pix_key'           => $withdrawal->chave_pix,
                        'pix_type'          => $withdrawal->tipo_chave,
                        'amount'            => $withdrawal->amount,
                        'suitpayment_id'    => $suitpayment->id
                    ];

                    $resp = self::pixCashOut($parm);

                    if($resp['status']) {
                        $withdrawal->update(['status' => 1]);
                        Notification::make()
                            ->title('Saque solicitado')
                            ->body($resp['message'])
                            ->success()
                            ->send();

                        return back();
                    } else {
                        Notification::make()
                            ->title('Erro no saque')
                            ->body($resp['message'])
                            ->danger()
                            ->send();

                        return back();
                    }
                }
            }
        }
    }

}
