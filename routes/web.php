<?php

use App\Http\Controllers\AsistenciaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad;
use App\Http\Controllers\Seguridad\PermisosController;
use App\Http\Controllers\Seguridad\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClasesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriasController;
use App\Livewire\CreateClaseModal;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('permisos', PermisosController::class);

    Route::resource('roles', RolesController::class);

    Route::resource('users', UsuariosController::class);

    Route::resource('clases', ClasesController::class);

    Route::resource('materias', MateriasController::class);

    Route::resource('asistencias', AsistenciaController::class);

});
