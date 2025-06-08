<?php

use App\Models\Merchants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\PaymentGatewayController;

Route::get('/merchant', function () {
    return view('merchant.index');
})->name('merchant.dashboard');

Route::get('/merchant/transactions', function () {
    return view('merchant.tnx.transactions');
})->name('merchant.tnx');

Route::get('/merchant/MerchantInfo', function () {
    $id = Auth::user()->user_id;
   $Merchant = Merchants::where('user_id', $id)->get()->toArray();
  $Merchantinfo = $Merchant[0];
  //dd($Merchantinfo);
    return view('merchant.profile.index',compact('Merchantinfo'));
})->name('merchant.profile');


Route::get('/merchant/sms&email', function () {
    return view('merchant.sms.index');
})->name('merchant.sms');

//Links
Route::get('/merchant/paywithlink', function () {
    return view('merchant.paywithlink.pwl');
})->name('merchant.paywithlink');

Route::post('/CreateLink',[LinksController::class,'store'])->name('links.store');

Route::post('/merchant/payment', [PaymentGatewayController::class, 'Auth'])->name('Auth');
