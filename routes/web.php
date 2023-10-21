<?php

use App\Http\Controllers\Api\UserController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
});
Route::get('image/user/{uri}', [UserController::class,'displayImage'])->name('displayImage');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/user', 'user');
        Route::get('/user/{id}', 'userDetail');
        Route::get('/perusahaan', 'perusahaan');
        Route::get('/prakerin', 'prakerin');
        Route::get('/pengajuan', 'pengajuan');
        Route::get('/monitoring', 'monitoring');
        Route::get('/jurusan', 'jurusan');
        Route::get('/jurusan/{id}', 'jurusanDetail');
    });
});