<?php

use App\Http\Controllers\PaymentGatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/merchant/backendcallback', [UserController::class, 'backendcallback']);
Route::post('/merchant/payment/backendcallback/{merchant_id}', [PaymentGatewayController::class, 'paymentBackendCallback']);





