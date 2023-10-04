<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RecoveryPasswordController;
use App\Http\Controllers\Configuration\Configuration;
use App\Http\Controllers\DirectDistributor\DirectDistributor;
use App\Http\Controllers\DirectDistributor\auth\LoginController as DirectDistributorLoginController;
use App\Http\Controllers\DirectDistributor\auth\RecoveryPasswordController as DirectDistributorRecoveryPasswordController;
use App\Http\Controllers\DirectDistributor\UserData;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// admin
Route::prefix('admin')->group(function () {
    // user
    Route::resource('user', AdminController::class);
    // direct distributor
    Route::resource('direct-distributor', DirectDistributor::class);

    // configuration
    Route::controller(Configuration::class)->group(function() {
        Route::get('/config/cost-date','getCostDate');
        Route::put('/config/cost-date','putCostDate');
        Route::get('/config/email-quotation','getMailQuotation');
        Route::put('/config/email-quotation','putMailQuotation');
    });
})->middleware('auth:sanctum:admin');

// Não autorizado
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


// admin
Route::prefix('/')->group(function () {
    // user
    Route::resource('user', UserData::class);
})->middleware('auth:sanctum:direct-distributor');


// Não autorizado
Route::prefix('/')->group(function () {
    // Rota para login
    Route::post('/login', [DirectDistributorLoginController::class, 'login']);

    // Recuperar senha
    Route::controller(DirectDistributorRecoveryPasswordController::class)->group(function() {
        Route::post('/recover-password','create');
        Route::post('/recover-password/code','verifyCode');
        Route::post('/recover-password/code/change-password','changePassword');
    });
});