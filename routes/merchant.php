<?php

use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\PaymentGatewayController;
use App\Models\sms;

Route::get('/merchant', function () {
    return view('merchant.index');
})->name('merchant.dashboard');

Route::get('/merchant/transactions', function () {

     $id = Auth::user()->user_id;
   $Merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
    $tnx = Tnx::where('created_by', $Merchant['merchant_id'])->get();
    return view('merchant.tnx.transactions',compact('tnx'));
})->name('merchant.tnx');

Route::get('/merchant/MerchantInfo', function () {
    $id = Auth::user()->user_id;
   $Merchant = Merchants::where('user_id', $id)->get()->toArray();
   $Merchantinfo = $Merchant[0];
    return view('merchant.profile.index',compact('Merchantinfo'));
})->name('merchant.profile');


Route::get('/merchant/sms&email', function () {
    $id = Auth::user()->user_id;
    $links = Links::where('user_id', $id)->get();
    return view('merchant.sms.index',compact('links'));
})->name('merchant.sms');

//Links
Route::get('/merchant/paywithlink', function () {
    $id = Auth::user()->user_id;
    $merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
    $email = sms::where('merchant_id',$merchant['merchant_id'])->get();
    return view('merchant.paywithlink.pwl',compact('email','merchant'));
})->name('merchant.paywithlink');

Route::post('/CreateLink',[LinksController::class,'store'])->name('links.store');
Route::post('/merchant/payment', [PaymentGatewayController::class, 'Auth'])->name('Auth');
Route::post('/merchant/PayNow', [PaymentGatewayController::class, 'Pwl'])->name('Pwl');

