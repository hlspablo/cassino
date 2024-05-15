<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Models\SuitPayPayment;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Traits\Gateways\SuitpayTrait;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

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
        return self::requestQrcode($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function consultStatusTransactionPix(Request $request)
    {
        return self::consultStatusTransaction($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function withdrawalFromModal($id)
    {
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

                if($resp) {
                    $withdrawal->update(['status' => 1]);
                    Notification::make()
                        ->title('Saque solicitado')
                        ->body('Saque solicitado com sucesso')
                        ->success()
                        ->send();

                    return back();
                } else {
                    Notification::make()
                        ->title('Erro no saque')
                        ->body('Erro ao solicitar o saque')
                        ->danger()
                        ->send();

                    return back();
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
