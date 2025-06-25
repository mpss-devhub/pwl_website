<?php

use App\Http\Controllers\Admin\AdminTnxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Permissions;

Route::get('/admin/dashboard', function () {
    return view('Admin.index');
})->name('admin.dashboard');

Route::get('/admin/Profile', function () {
    return view('Admin.profile.index');
})->name('profile.show');

Route::get('/admin/sms&email', function () {
    return view('Admin.sms.index');
})->name('sms.show');

Route::get('/admin/paymentLimitations', function () {
    return view('Admin.payment.index');
})->name('payment.show');

Route::get('/admin/support', function () {
    return view('Admin.support.index');
})->name('support.show');


// User Management
Route::get('/admin/User', function () {
    $admins = User::where('role', 'admin')->paginate(6);
    $per = Permissions::all();
    return view('Admin.user.list',compact('admins','per'));
})->name('user.show');

Route::get('/admin/Update/{id}', function ($id) {
    $users = User::where('id', $id)->get();
    return view('Admin.user.update', compact('users'));
})->name('user.show.update');

Route::get('/admin/UserCreate', function () { $per = Permissions::all();
       return view('Admin.user.create',compact('per'));})->name('user.create');
Route::get('/admin/User/Delete/{id}',[UserController::class,'delete'])->name('user.delete');
Route::post('/admin/Create/',[UserController::class,'store'])->name('user.store');
Route::post('/admin/Update/{id}',[UserController::class,'update'])->name('user.update');


//Admin Management
Route::get('/admin/access&control', function () { $p = Permissions::paginate(8);
       return view('Admin.access.index',compact('p')); })->name('access.show');
Route::get('/admin/AddNewAccess',function (){ return view('Admin.access.create'); })->name('access.create');
Route::post('/admin/NewAccess',[PermissionsController::class,'store'])->name(name: 'access.store');


//Merchant Management
Route::get('/admin/MerchantCreate', function () { return view('Admin.merchant.create');})->name('merchant.create');
Route::get('/admin/MerchantList',[AdminController::class,'index'])->name('merchant.show');
Route::post('/admin/CreateMerchant/',[UserController::class,'storeMerchant'])->name('merchant.store');
Route::get('View/Merchant/Details/{id}',[AdminController::class,'merchantdetail'])->name('merchant.detail');
Route::get('Update/Merchant/Data/{id}',[AdminController::class,'update'])->name('merchant.update');
Route::post('Update/Merchant}',[AdminController::class,'merchantupdate'])->name('merchant.update.post');
Route::get('View/Merchant/MDRSetup/{id}',[AdminController::class,'mdr'])->name('merchant.mdr');


//SMS Management
Route::get('/admin/sms&email/{id}', [AdminController::class, 'sms'])->name('sms.show');
Route::post('/admin/Create/sms&email/', [AdminController::class,'create'])->name('sms.create');
Route::get('/admin/sms&email/delete/{id}',[AdminController::class,'delete'])->name('sms.delete');


//Tnx Management
Route::get('/admin/Transaction',[AdminTnxController::class ,'show'])->name('tnx.show');
