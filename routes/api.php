<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
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
Route::resource('admin', AdminController::class)->middleware('auth:sanctum');

// Não autorizado
Route::prefix('admin')->namespace('admin')->group(function () {
    // Rota para login
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/recover-password', [LoginController::class, 'recoverPassword'])->name('login');
});