<?php

use App\Http\Controllers\Api\JenisPerusahaanController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\PengajuanController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/profile/{id}', 'profile')->middleware('auth');
});

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::controller(PerusahaanController::class)->group(function () {
        Route::get('/perusahaan', 'index');
        Route::get('/perusahaan/{id}/detail', 'detail');
    });
    Route::controller(JenisPerusahaanController::class)->group(function () {
        Route::get('/perusahaan/jenis', 'index');
        Route::get('/perusahaan/jenis/{id}', 'detail');
    });
    Route::controller(PengajuanController::class)->group(function () {
        Route::get('/pengajuan', 'index');
    });
    Route::get('/log', [DashboardController::class, 'log'])->middleware('checkRole:hubin');
});
