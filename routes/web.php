<?php

use App\Http\Controllers\Api\JenisPerusahaanController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\PengajuanController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisplayImage;
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
});
Route::get('image/{uri}', [DisplayImage::class, 'displayImage'])->name('displayImage');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/user', 'user');
        Route::get('/user/{role}', 'userRole')->whereIn('role', ['tu', 'siswa', 'kaprog', 'pembimbing', 'walas', 'hubin',]);
        Route::get('/user/{id}', 'userDetail');
        Route::get('/user/edit/{id}', 'userEdit');

        Route::get('/perusahaan/jenis', 'jenisPerusahaan');
        Route::get('/perusahaan/jenis/{id}', 'jenisPerusahaanDetail');

        Route::get('/perusahaan', 'perusahaan');
        Route::get('/perusahaan/{id}', 'perusahaanDetail');


        Route::get('/prakerin', 'prakerin');

        Route::get('/penagjuan', 'pengajuan');

        Route::get('/pengajuan', 'pengajuan');

        Route::get('/monitoring', 'monitoring');
        Route::get('/kelas', 'kelas');
        Route::get('/kelas/{id}', 'kelasDetail');

        Route::get('/jurusan', 'jurusan');
        Route::get('/jurusan/{id}', 'jurusanDetail');

        Route::get('/log', [DashboardController::class, 'log'])->middleware('checkRole:hubin');
    });
});