<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DatosController as AdminDatosController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\Paciente\DatosController as PacienteDatosController;
use App\Http\Controllers\Especialista\DatosController as EspecialistaDatosController;
use App\Http\Controllers\Especialista\EspecialistaController;
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

Route::post('password/forgot', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword']);

// Rutas para el admin -----------------------------------------------------------------

Route::group(['middleware' => ['jwt.auth', 'role:admin']], function () {
    Route::get('admin/me', [AdminDatosController::class, 'me']);

    Route::prefix('especialista')->group(function () {
        Route::get('obtenerEspecialistas', [AdminController::class, 'obtenerEspecialistas']);
        Route::post('agregarEspecialista', [AdminController::class, 'registrarEspecialista']);
        Route::post('activarEspecialista/{dni}', [AdminController::class, 'activarEspecialista']);

        Route::delete('desactivarEspecialista/{dni}', [AdminController::class, 'desactivarEspecialista']);
        Route::delete('eliminarEspecialista/{dni}', [AdminController::class, 'eliminarEspecialista']);
    });

    Route::prefix('especialidad')->group(function () {
        Route::get('obtenerEspecialidades', [EspecialidadController::class, 'obtenerEspecialidades']);
        Route::post('agregarEspecialidad', [EspecialidadController::class, 'agregarEspecialidad']);
        Route::put('actualizarEspecialidad/{id}', [EspecialidadController::class, 'actualizarEspecialidad']);

        Route::delete('desactivarEspecialidad/{id}', [EspecialidadController::class, 'desactivarEspecialidad']);
        Route::delete('eliminarEspecialidad/{id}', [EspecialidadController::class, 'eliminarEspecialidad']);
    });
});

// Rutas para el especialista -----------------------------------------------------------------

Route::group(['middleware' => ['jwt.auth', 'role:especialista,admin']], function () {
    Route::get('especialista/me', [EspecialistaDatosController::class, 'me']);

    Route::prefix('paciente')->group(function () {
        Route::get('obtenerPacientes', [EspecialistaController::class, 'obtenerPacientes']);
        Route::post('agregarPaciente', [EspecialistaController::class, 'registrarPaciente']);
        Route::post('activarPaciente/{dni}', [EspecialistaController::class, 'activarPaciente']);

        Route::delete('desactivarPaciente/{dni}', [EspecialistaController::class, 'desactivarPaciente']);
        Route::delete('eliminarPaciente/{dni}', [EspecialistaController::class, 'eliminarPaciente']);
    });
});

// Rutas para el paciente -----------------------------------------------------------------

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('paciente/me', [PacienteDatosController::class, 'me']);
});
