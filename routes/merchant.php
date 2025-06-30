<?php

use App\Models\sms;
use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\Merchant\TnxController;
use App\Http\Controllers\Merchant\MerchantDashboardController;
use App\Http\Controllers\Merchant\SMSController;

// Merchant Dashboard Routes
Route::get('/merchant', [MerchantDashboardController::class , 'show'] )->name('merchant.dashboard');



//Merchant Info Management
Route::get('/merchant/MerchantInfo', function () {
    $id = Auth::user()->user_id;
   $Merchant = Merchants::where('user_id', $id)->get()->toArray();
   $Merchantinfo = $Merchant[0];
    return view('merchant.profile.index',compact('Merchantinfo'));
})->name('merchant.profile');


//Link Management
Route::get('/merchant/paywithlink', function () {
    $id = Auth::user()->user_id;
    $merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
    $email = sms::where('merchant_id',$merchant['merchant_id'])->get();
    return view('merchant.paywithlink.pwl',compact('email','merchant'));
})->name('merchant.paywithlink');
Route::post('/CreateLink',[LinksController::class,'store'])->name('links.store');
Route::post('/merchant/payment', [PaymentGatewayController::class, 'Auth'])->name('Auth');
Route::post('/merchant/PayNow', [PaymentGatewayController::class, 'Pwl'])->name('Pwl');


//Tnx Management
Route::get('/merchant/transactions', function () {
     $id = Auth::user()->user_id;
   $Merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
    $tnx = Tnx::where('created_by', $Merchant['merchant_id'])
              ->latest('created_at')
              ->paginate(20);
    return view('merchant.tnx.transactions',compact('tnx'));
})->name('merchant.tnx');
Route::post('/tnx/Links/detail',[TnxController::class,'detail'])->name('tnx.detail');
Route::post('/tnx/Payment/detail',[TnxController::class,'paymentdetail'])->name('Payment.detail');


//SMS&Email Management
Route::get('/merchant/sms&email', function () {
    $id = Auth::user()->user_id;
    $m_id = Merchants::where('user_id', $id)->select('merchant_id')->first();
    $links = Links::where('created_by', $m_id['merchant_id'])
            ->latest('created_at')
              ->paginate(20);
    return view('merchant.sms.index',compact('links'));
})->name('merchant.sms');
Route::post('/sms/details',[SMSController::class,'show'])->name(name: 'sms.details');
Route::post('sms/email/resent',[SMSController::class ,'resent'])->name('sms.resent');
