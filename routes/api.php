<?php

use App\Http\Controllers\Api\JenisPerusahaanController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\ApiAuthMiddleware;
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

Route::middleware(ApiAuthMiddleware::class)->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login')->withoutMiddleware(ApiAuthMiddleware::class);
        Route::get('/me', 'getUser');
        Route::get('/logout', 'logout');
    });

    Route::controller(JurusanController::class)->group(function () {
        Route::get('/jurusan', 'getAll');
        Route::post('/jurusan', 'create');
        Route::get('/jurusan/{id}', 'getOne')->where('id', '[0-9]+');
        Route::put('/jurusan/{id}', 'update')->where('id', '[0-9]+');
        Route::delete('/jurusan/{id}', 'delete')->where('id', '[0-9]+');
    });
    
    Route::controller(KelasController::class)->group(function () {
        Route::get('/kelas', 'getAll');
        Route::post('/kelas', 'create');
        Route::get('/kelas/{id}', 'getOne')->where('id', '[0-9]+');
        Route::put('/kelas/{id}', 'update')->where('id', '[0-9]+');
        Route::delete('/kelas/{id}', 'delete')->where('id', '[0-9]+');
    });
    
    Route::controller(JenisPerusahaanController::class)->group(function () {
        Route::get('/perusahaan/jenis', 'getAll');
        Route::post('/perusahaan/jenis', 'create');
        Route::get('/perusahaan/jenis/{id}', 'getOne')->where('id', '[0-9]+');
        Route::put('/perusahaan/jenis/{id}', 'update')->where('id', '[0-9]+');
        Route::delete('/perusahaan/jenis/{id}', 'delete')->where('id', '[0-9]+');
    });
    
    Route::controller(PerusahaanController::class)->group(function () {
        Route::get('/perusahaan', 'getAll');
        Route::post('/perusahaan', 'create');
        Route::get('/perusahaan/{id}', 'getOne')->where('id', '[0-9]+');
        Route::put('/perusahaan/{id}', 'update')->where('id', '[0-9]+');
        Route::delete('/perusahaan/{id}', 'delete')->where('id', '[0-9]+');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'getAll');
        Route::get('/user/{role}/{id}', 'getOne')->whereIn('role', ['siswa', 'walas', 'kaprog', 'pembimbing', 'hubin', 'tata_usaha']);
        Route::post('/user/{role}', 'create')->whereIn('role', ['siswa', 'walas', 'kaprog', 'pb_industri', 'pb_sekolah', 'hubin', 'tu']);
        Route::put('/user/{role}/{id}', 'update')->whereIn('role', ['siswa', 'walas', 'kaprog', 'pb_industri', 'pb_sekolah', 'hubin', 'tu']);
        Route::delete('/user/{id}', 'delete');
    });
});

