<?php

use App\Http\Controllers\Api\PerusahaanController;
use Illuminate\Http\Request;
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

Route::controller(PerusahaanController::class)->group(function () {
    Route::get('/perusahaan', 'getAll');
    Route::post('/perusahaan', 'create');
    Route::get('/perusahaan/{id}', 'getById');
    Route::delete('/perusahaan/{id}', 'delete');
});
