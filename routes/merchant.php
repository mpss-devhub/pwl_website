<?php

use App\Exports\MerchantLinksExport;
use App\Models\sms;
use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use App\Exports\MerchantTnxExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\Merchant\SMSController;
use App\Http\Controllers\Merchant\TnxController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\Merchant\MerchantDashboardController;
use App\Http\Controllers\Merchant\NotificationController;
use App\Http\Controllers\Merchant\SettlementController;
use App\Http\Controllers\MerchantsController;

Route::middleware(['merchant'])->group(function () {

    // Merchant Dashboard Routes
    Route::get('/merchant', [MerchantDashboardController::class, 'show'])->name('merchant.dashboard');

    //Merchant Info Management
    Route::get('/merchant/MerchantInfo', function () {
        $id = Auth::user()->user_id;
        $Merchant = Merchants::where('user_id', $id)->get()->toArray();
        $Merchantinfo = $Merchant[0];
        return view('Merchant.profile.index', compact('Merchantinfo'));
    })->name('merchant.profile');



    //Link Management
    Route::get('/bundle/import', [LinksController::class, 'bundle'])->name('links.bundle');
    Route::post('/import-links', [LinksController::class, 'importLinks'])->name('links.import');
    Route::get('/merchant/paywithlink', function () {
        $id = Auth::user()->user_id;
        $merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
        $email = sms::where('merchant_id', $merchant['merchant_id'])->get();
        return view('Merchant.paywithlink.pwl', compact('email', 'merchant'));
    })->name('merchant.paywithlink');
    Route::post('/CreateLink', [LinksController::class, 'store'])->name('links.store');
    Route::get('/Link/Edit/{id}', [LinksController::class, 'edit'])->name('merchant.link.edit');
    Route::put('/Links/{id}/Update', [LinksController::class, 'update'])->name('links.update');
    Route::get('/Merchant/Link/CSV/Exports', function () {
        $created_by = Merchants::where('user_id', Auth::user()->user_id)->select('merchant_id')->first();
        return Excel::download(new MerchantLinksExport($created_by), 'Merchant-Link.xlsx');
    })->name('merchant.link.excel.export');
    Route::get('/Merchant/Link/Excel/Exports', function () {
        $created_by = Merchants::where('user_id', Auth::user()->user_id)->select('merchant_id')->first();
        return Excel::download(new MerchantLinksExport($created_by), 'Merchant-Link.csv');
    })->name('merchant.link.csv.export');


    //Tnx Management
    Route::get('/merchant/transactions',[TnxController::class , 'index'])->name('merchant.tnx');
    Route::post('/tnx/Links/detail', [TnxController::class, 'detail'])->name('tnx.detail');
    Route::post('/tnx/Payment/detail', [TnxController::class, 'paymentdetail'])->name('Payment.detail');
    Route::get('/Merchant/tnx/Exports', function () {
        $created_by = Merchants::where('user_id', Auth::user()->user_id)->select('merchant_id')->first();
        return Excel::download(new MerchantTnxExport($created_by), 'Merchant-Transactions.xlsx');
    })->name('merchant.tnx.export');
    Route::get('/Merchant/csv/Exports', function () {
        $created_by = Merchants::where('user_id', Auth::user()->user_id)->select('merchant_id')->first();
        return Excel::download(new MerchantTnxExport($created_by), 'Merchant-Transactions.csv');
    })->name('merchant.csv.export');


    //SMS&Email Management
    Route::get('/merchant/sms&email',[SMSController::class,'index'])->name('merchant.sms');
    Route::post('/sms/details', [SMSController::class, 'show'])->name(name: 'sms.details');
    Route::post('sms/email/resent', [SMSController::class, 'resent'])->name('sms.resent');


    //Notification Management
    Route::get('merchant/notification', [NotificationController::class, 'show'])->name('merchant.notification');
    Route::get('merchant/Notification/details/{encryptedId}', [NotificationController::class, 'details'])->name('merchant.notification.details');

    //Settlement Status
    Route::get('merchant/Settlement', [SettlementController::class, 'show'])->name('merchant.settlement');
    Route::get('merchant/Settlement/details/{id}', [SettlementController::class, 'details'])->name('merchant.settlement.details');
    Route::get('merchant/Settlement/Export', [SettlementController::class, 'export'])->name('merchant.settlement.export');
    Route::get('merchant/Settlement/CSVExport', [SettlementController::class, 'csvExport'])->name('merchant.settlement.csv.export');

    //MDR Rate
    Route::get('/View/Merchant/MDRSetup',[MerchantsController::class,'mdr'])->name('mdr');
});
