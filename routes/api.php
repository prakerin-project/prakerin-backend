<?php

use App\Http\Controllers\Api\JenisPerusahaanController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\PerusahaanController;
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

Route::controller(JurusanController::class)->group(function () {
    Route::get('/jurusan', 'getAll');
    Route::post('/jurusan', 'create');
    Route::get('/jurusan/{id}', 'getOne')->where('id', '[0-9]+');
    Route::put('/jurusan/{id}', 'update')->where('id', '[0-9]+');
    Route::delete('/jurusan/{id}', 'delete')->where('id', '[0-9]+');
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

