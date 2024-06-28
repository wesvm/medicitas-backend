<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DatosController as AdminDatosController;
use App\Http\Controllers\Paciente\DatosController as PacienteDatosController;
use App\Http\Controllers\Especialista\DatosController as EspecialistaDatosController;
use App\Http\Controllers\ForgotPasswordController;

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

    Route::post('admin/agregarEspecialista', [AdminController::class, 'registrarEspecialista']);
});

Route::group(['middleware' => ['jwt.auth', 'role:especialista,admin']], function () {
    Route::get('obtenerPacientes', [PacienteDatosController::class, 'obtenerPacientes']);
    Route::get('obtenerEspecialistas', [EspecialistaDatosController::class, 'obtenerEspecialistas']);
});

Route::get('paciente/me', [PacienteDatosController::class, 'me']);
Route::get('especialista/me', [EspecialistaDatosController::class, 'me']);

Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);
