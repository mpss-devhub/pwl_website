<?php

use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use Mews\Captcha\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/merchant.php';
require __DIR__ . '/api.php';


Route::get('/', function () {
    return view('main.home');
})->name('main.home');

Route::get('/captcha/{config?}', function (Captcha $captcha, $config = 'flat') {
    return $captcha->create($config);
});

//Change Password
Route::get('/changepassword', function () {
    Auth::logout();
    return to_route('password.request');
})->name('forgotpassword');

Route::get('/pay/{token}', [LinksController::class, 'show']);


Route::get('Check/user', [CheckUserController::class, 'page'])
    ->name('check.page');

Route::post('/Checked', [CheckUserController::class, 'check'])
    ->name('check');

Route::get('/invoice/{invoiceNo}', function ($invoiceNo) {
    $link = Links::where('link_invoiceNo', $invoiceNo)->firstOrFail();
    $tnx = Tnx::where('link_id', $link->id)->latest()->firstOrFail();
    $merchant = Merchants::where('user_id', $link->user_id)->firstOrFail();
    if ($tnx->payment_status === 'SUCCESS') {
        return view('Extra.success', compact('merchant', 'link', 'tnx'));
    }
    if ($tnx->payment_status === 'FAILED') {
        return view('Extra.fail', compact('merchant', 'link', 'tnx'));
    }
})->name('payment.invoice');

Route::get('/check-payment/{invoiceNo}', function ($invoiceNo) {
    $link = Links::where('link_invoiceNo', $invoiceNo)->first();
    $tnx = Tnx::where('link_id', $link->id)->latest()->first();
    if (!$tnx) {
        return response()->json(['status' => false]);
    }
    if ($tnx->payment_status !== 'PENDING') {
        return response()->json(['status' => true]);
    }
});
