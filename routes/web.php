<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::prefix('/dashboard')->group(function() {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/user', 'user');
        Route::get('/perusahaan', 'perusahaan');
        Route::get('/prakerin', 'prakerin');
        Route::get('/pengajuan', 'pengajuan');
        Route::get('/monitoring', 'monitoring');
    });
});
