<?php

use App\Models\User;
use App\Models\Links;
use App\Models\Permissions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\Admin\AdminSmScontroller;
use App\Http\Controllers\Admin\AdminTnxController;
use App\Http\Controllers\Admin\AdminDashboardController;



Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');

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
     $per = Permissions::all();
    return view('Admin.user.update', compact('users','per'));
})->name('user.show.update');

Route::get('/admin/UserCreate', function () { $per = Permissions::all();
       return view('Admin.user.create',compact('per'));})->name('user.create');
Route::get('/admin/User/Delete/{id}',[UserController::class,'delete'])->name('user.delete');
Route::post('/admin/Create/',[UserController::class,'store'])->name('user.store');
Route::post('/admin/Update/{id}',[UserController::class,'update'])->name('user.update');


//Admin Management
Route::get('/admin/access&control', function () {
    $p = Permissions::withCount('users')->get();
    return view('Admin.access.index', compact('p'));
})->name('access.show');
Route::get('/admin/access/edit/{id}', [PermissionsController::class, 'edit'])->name('access.edit');
Route::get('/admin/AddNewAccess',function (){ return view('Admin.access.create'); })->name('access.create');
Route::post('/admin/NewAccess',[PermissionsController::class,'store'])->name(name: 'access.store');
Route::put('/permissions/update/{id}', [PermissionsController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/delete/{id}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');



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
//SMS&Email Management
Route::get('/admin/link', function () {
    $links = Links::latest()->get();
    return view('Admin.links.index', compact('links'));
})->name('admin.links');
Route::post('admin/sms/details', [AdminSmScontroller::class, 'show'])->name(name: 'admin.sms.details');
Route::post('admin/sms/email/resent', [AdminSmScontroller::class, 'resent'])->name('admin.sms.resent');
Route::get('/admin/link/export/csv', [AdminSmScontroller::class, 'exportCsv'])->name('admin.link.csv.export');
Route::get('/admin/link/export/excel', [AdminSmScontroller::class, 'exportExcel'])->name('admin.link.tnx.export');
Route::get('admin/Link/Edit/{id}',[AdminSmScontroller::class,'edit'])->name('admin.link.edit');
Route::put('admin/Links/{id}/Update', [AdminSmScontroller::class, 'update'])->name('admin.links.update');

//Tnx Management
Route::get('/admin/Transaction',[AdminTnxController::class ,'show'])->name('tnx.show');
Route::get('/admin/merchant/export/csv', [AdminTnxController::class, 'exportCsv'])->name('admin.merchant.csv.export');
Route::get('/admin/merchant/export/excel', [AdminTnxController::class, 'exportExcel'])->name('admin.merchant.tnx.export');
Route::post('admin/tnx/Links/detail', [AdminTnxController::class, 'detail'])->name('admin.tnx.detail');
Route::post('admin/tnx/Payment/detail', [AdminTnxController::class, 'paymentdetail'])->name('admin.Payment.detail');

});
