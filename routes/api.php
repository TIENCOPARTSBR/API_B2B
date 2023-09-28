<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RecoveryPasswordController;
use App\Http\Controllers\Configuration\Configuration;
use App\Http\Controllers\DirectDistributor\DirectDistributor;
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

// Admin
Route::prefix('admin')->group(function () {
    Route::resource('user', AdminController::class);
    Route::resource('direct-distributor', DirectDistributor::class);
    Route::controller(Configuration::class)->group(function() {
        Route::get('/config/cost-date','getCostDate');
        Route::put('/config/cost-date','putCostDate');
        Route::get('/config/email-quotation','getMailQuotation');
        Route::put('/config/email-quotation','putMailQuotation');
    });
})->middleware('auth:sanctum');

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