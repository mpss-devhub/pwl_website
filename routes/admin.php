    <?php

use App\Models\User;
use App\Models\Links;
use App\Models\Merchants;
use App\Models\Permissions;
use App\Models\announcement;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Admin\AdminSmScontroller;
use App\Http\Controllers\Admin\AdminTnxController;
use App\Http\Controllers\Admin\SettlementController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['admin'])
    ->prefix('admin')
    ->group(function () {

    // Navigation
    Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/Profile', fn() => view('Admin.profile.index'))->name('profile.show');
    Route::get('/sms&email', fn() => view('Admin.sms.index'))->name('sms.show');
    Route::get('/paymentLimitations', fn() => view('Admin.payment.index'))->name('payment.show');
    Route::get('/support/list', function () {
        $data = announcement::get();
        return view('Admin.support.list',compact('data'));
    })->name('support.list');
    Route::get('/support', function () {
        $merchants = Merchants::where('status','on')->get();
        return view('Admin.support.index',compact('merchants'));
    })->name('support.show');
    Route::get('/Settlement',[SettlementController::class,'show'])->name('admin.settlement');
    Route::get('/Settlement/Details/{merchant}/{id}', [SettlementController::class, 'details'])->name('admin.settlement.details');

    // User Management
    Route::get('/User', function () {
        $admins = User::where('role', 'admin')->paginate(6);
        $per = Permissions::all();
        return view('Admin.user.list',compact('admins','per'));
    })->name('user.show');
    Route::get('/Update/{id}', function ($id) {
        $users = User::where('id', $id)->get();
        $per = Permissions::all();
        return view('Admin.user.update', compact('users','per'));
    })->name('user.show.update');
    Route::get('/UserCreate', function () {
        $per = Permissions::all();
        return view('Admin.user.create',compact('per'));
    })->name('user.create');
    Route::get('/User/Delete/{id}',[UserController::class,'delete'])->name('user.delete');
    Route::post('/Create',[UserController::class,'store'])->name('user.store');
    Route::post('/Update/{id}',[UserController::class,'update'])->name('user.update');

    // Admin Management
    Route::get('/access&control', function () {
        $p = Permissions::withCount('users')->get();
        return view('Admin.access.index', compact('p'));
    })->name('access.show');

    Route::get('/access/edit/{id}', [PermissionsController::class, 'edit'])->name('access.edit');
    Route::get('/AddNewAccess', fn() => view('Admin.access.create'))->name('access.create');
    Route::post('/NewAccess',[PermissionsController::class,'store'])->name('access.store');
    Route::put('/permissions/update/{id}', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/delete/{id}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');

    // Merchant Management
    Route::get('/MerchantCreate', fn() => view('Admin.merchant.create'))->name('merchant.create');
    Route::get('/MerchantList',[AdminController::class,'index'])->name('merchant.show');
    Route::post('/CreateMerchant',[UserController::class,'storeMerchant'])->name('merchant.store');
    Route::get('/View/Merchant/Details/{id}',[AdminController::class,'merchantdetail'])->name('merchant.detail');
    Route::get('/Update/Merchant/Data/{id}',[AdminController::class,'update'])->name('merchant.update');
    Route::post('/Update/Merchant/POST',[AdminController::class,'merchantupdate'])->name('merchant.update.post');
    Route::get('/View/Merchant/MDRSetup/{id}',[AdminController::class,'mdr'])->name('merchant.mdr');

    // SMS Management
    Route::get('/sms&email/{id}', [AdminController::class, 'sms'])->name('sms.show');
    Route::post('/Create/sms&email', [AdminController::class,'create'])->name('sms.create');
    Route::get('/sms&email/delete/{id}',[AdminController::class,'delete'])->name('sms.delete');

    // SMS & Email Management
    Route::get('/link', [AdminSmScontroller::class,'index'])->name('admin.links');

    Route::post('/sms/details', [AdminSmScontroller::class, 'show'])->name('admin.sms.details');
    Route::post('/sms/email/resent', [AdminSmScontroller::class, 'resent'])->name('admin.sms.resent');
    Route::get('/link/export/csv', [AdminSmScontroller::class, 'exportCsv'])->name('admin.link.csv.export');
    Route::get('/link/export/excel', [AdminSmScontroller::class, 'exportExcel'])->name('admin.link.tnx.export');
    Route::get('/Link/Edit/{id}',[AdminSmScontroller::class,'edit'])->name('admin.link.edit');
    Route::put('/Links/{id}/Update', [AdminSmScontroller::class, 'update'])->name('admin.links.update');

    // Transaction Management
    Route::get('/Transaction',[AdminTnxController::class ,'show'])->name('tnx.show');
    Route::get('/merchant/export/csv', [AdminTnxController::class, 'exportCsv'])->name('admin.merchant.csv.export');
    Route::get('/merchant/export/excel', [AdminTnxController::class, 'exportExcel'])->name('admin.merchant.tnx.export');
    Route::post('/tnx/Links/detail', [AdminTnxController::class, 'detail'])->name('admin.tnx.detail');
    Route::post('/tnx/Payment/detail', [AdminTnxController::class, 'paymentdetail'])->name('admin.Payment.detail');

    // Support Management
    Route::post('/support/announcement',[AnnouncementController::class,'store'])->name('support.announcement');
    Route::get('/support/announcement/details/{id}',[AnnouncementController::class,'details'])->name('support.details');
    Route::get('/support/announcement/delete/{id}',[AnnouncementController::class,'delete'])->name('support.delete');
    Route::get('/support/announcement/edit/{id}',[AnnouncementController::class,'edit'])->name('support.edit');
    Route::put('/support/announcement/update/{id}',[AnnouncementController::class,'update'])->name('support.update');




});

