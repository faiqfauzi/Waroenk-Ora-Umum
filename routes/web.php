<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

Route::get('/table/{id}', [OrderController::class, 'showTable']);

Route::post('/payment/manual/{tableId}', [PaymentController::class, 'manual']);


// Route for confirming payment (after checkout)
Route::post('payment/create/{id}', [PaymentController::class, 'checkout']);


Route::get('/payment/success', [PaymentController::class, 'paymentSuccess']);
// Confirm payment after the transaction





