<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckUserController;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/merchant.php';
require __DIR__ . '/api.php';


Route::get('/', function () {
    return view('main.home');
});

Route::get('/pay/{token}',[LinksController::class,'show']);


Route::get('Check/user', [CheckUserController::class, 'page'])
    ->name('check.page');

Route::post('/Checked', [CheckUserController::class, 'check'])
    ->name('check');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
