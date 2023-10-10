<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RecoveryPasswordController;
use App\Http\Controllers\Configuration\Configuration;
use App\Http\Controllers\DirectDistributor\DirectDistributor;
use App\Http\Controllers\DirectDistributor\auth\LoginController as DirectDistributorLoginController;
use App\Http\Controllers\DirectDistributor\auth\RecoveryPasswordController as DirectDistributorRecoveryPasswordController;
use App\Http\Controllers\DirectDistributor\UserData\UserData;
use App\Http\Controllers\Product\ProductSearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| API Routes module Admin
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    // user
    Route::resource('user', AdminController::class)->middleware('auth:admin');

    // profile
    Route::get('/profile', function() {return auth()->user();})->middleware('auth:admin');

    // direct distributor
    Route::resource('/direct-distributor', DirectDistributor::class)->middleware('auth:admin');
    // user direct distributor
    Route::resource('/direct-distributor/user', UserData::class)->middleware('auth:admin');

    // configuration
    Route::controller(Configuration::class)->group(function() {
        Route::get('/config/cost-date','getCostDate');
        Route::put('/config/cost-date','putCostDate');
        Route::get('/config/email-quotation','getMailQuotation');
        Route::put('/config/email-quotation','putMailQuotation');
    })->middleware('auth:admin');
});

/*
|--------------------------------------------------------------------------
| Forbiden
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    // Rota para login
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    // Recuperar senha
    Route::controller(RecoveryPasswordController::class)->group(function() {
        Route::post('/recover-password','create');
        Route::post('/recover-password/code','verifyCode');
        Route::post('/recover-password/code/change-password','changePassword');
    });
});

/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| API Routes module direct distributor
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/
Route::prefix('/')->group(function () {
    // user
    Route::resource('user', UserData::class)->middleware('auth:directDistributor');
    Route::get('/profile', function() {return auth()->user();})->middleware('auth:directDistributor');

    Route::post('/product', [ProductSearchController::class, 'getProduct'])->middleware('auth:directDistributor');
});

/*
|--------------------------------------------------------------------------
| Forbiden
|--------------------------------------------------------------------------
*/
Route::prefix('/')->group(function () {
    // Rota para login
    Route::post('login', [DirectDistributorLoginController::class, 'login']);

    // Recuperar senha
    Route::controller(DirectDistributorRecoveryPasswordController::class)->group(function() {
        Route::post('recover-password','create');
        Route::post('recover-password/code','verifyCode');
        Route::post('recover-password/code/change-password','changePassword');
    });
});