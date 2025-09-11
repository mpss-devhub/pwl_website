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
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


require __DIR__ . '/api.php';
require __DIR__ . '/auth.php';

Route::middleware(['auth', 'session'])->group(function () {
    require __DIR__ . '/admin.php';
    require __DIR__ . '/merchant.php';
});

Route::get('/', function () {
    return view('main.home');
})->name('main.home');

//required to change
Route::get('/download/{file}', function ($file) {
    $url = "https://spaceoctoverse.sgp1.digitaloceanspaces.com/mpssuat/qr/$file";
    $content = file_get_contents($url);
    return response($content, 200)
        ->header('Content-Type', 'image/png')
        ->header('Content-Disposition', 'attachment; filename="' . $file . '"');
})->name('qr.download');

//required to change
Route::get('/download/{filename}', function ($filename) {
    $url = "https://spaceoctoverse.sgp1.digitaloceanspaces.com/mpssuat/merchant_data/" . $filename;
    $fileContents = file_get_contents($url);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_buffer($finfo, $fileContents);
    finfo_close($finfo);
    return response($fileContents)
        ->header('Content-Type', $mimeType)
        ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
})->name('merchant.download');



Route::get('/contactus', function () {
    return view('main.contactus');
})->name('main.contactus');

Route::get('/aboutus', function () {
    return view('main.aboutus');
})->name('main.aboutus');



//Change Password
Route::get('/changepassword', function () {
    Auth::logout();
    return to_route('password.request');
})->name('forgotpassword');

Route::get('/pay/{token}', [LinksController::class, 'show']);
Route::post('/merchant/payment', [PaymentGatewayController::class, 'Auth'])->name('Auth');
Route::post('/merchant/PayNow', [PaymentGatewayController::class, 'Pwl'])->name('Pwl');

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
    if ($tnx->payment_status === 'FAIL') {
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
