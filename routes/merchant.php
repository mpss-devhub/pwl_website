<?php

use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\PaymentGatewayController;

Route::get('/merchant', function () {
    return view('merchant.index');
})->name('merchant.dashboard');

Route::get('/merchant/transactions', function () {

     $id = Auth::user()->user_id;
   $Merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
    $tnx = Tnx::where('created_by', $Merchant['merchant_id'])->get();
   // dd($tnx[0]['link_id']);
    return view('merchant.tnx.transactions',compact('tnx'));
})->name('merchant.tnx');

Route::get('/merchant/MerchantInfo', function () {
    $id = Auth::user()->user_id;
   $Merchant = Merchants::where('user_id', $id)->get()->toArray();
   $Merchantinfo = $Merchant[0];
  //dd($Merchantinfo);
    return view('merchant.profile.index',compact('Merchantinfo'));
})->name('merchant.profile');


Route::get('/merchant/sms&email', function () {
    $id = Auth::user()->user_id;
    $links = Links::where('user_id', $id)->get();
   // dd($link);
    return view('merchant.sms.index',compact('links'));
})->name('merchant.sms');

//Links
Route::get('/merchant/paywithlink', function () {
    return view('merchant.paywithlink.pwl');
})->name('merchant.paywithlink');

Route::post('/CreateLink',[LinksController::class,'store'])->name('links.store');

Route::post('/merchant/payment', [PaymentGatewayController::class, 'Auth'])->name('Auth');
Route::post('/merchant/PayNow', [PaymentGatewayController::class, 'Pwl'])->name('Pwl');

