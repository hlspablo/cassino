<?php


use App\Http\Controllers\Gateway\SuitPayController;

Route::post('suitpay/qrcode-pix', [SuitPayController::class, 'getQRCodePix']);
Route::post('suitpay/consult-status-transaction', [SuitPayController::class, 'consultStatusTransactionPix']);
Route::post('suitpay/callback', [SuitPayController::class, 'callbackMethod']);

Route::get('suitpay/withdrawal/{id}', [SuitPayController::class, 'withdrawalFromModal'])->name('suitpay.withdrawal');
Route::get('suitpay/undo-withdrawal/{id}', [SuitPayController::class, 'undoWithdrawal'])->name('suitpay.undo-withdrawal');
