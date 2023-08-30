<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RecoveryPasswordController;
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
Route::resource('admin', AdminController::class);

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