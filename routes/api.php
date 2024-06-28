<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DatosController as AdminDatosController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Paciente\DatosController as PacienteDatosController;

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => ['jwt.auth', 'role:admin']], function () {
    Route::get('admin/me', [AdminDatosController::class, 'me']);
});

Route::get('paciente/me', [PacienteDatosController::class, 'me']);

Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);
