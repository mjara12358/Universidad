<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad;
use App\Http\Controllers\Seguridad\PermisosController;
use App\Http\Controllers\Seguridad\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClasesController;
use App\Livewire\CreateClaseModal;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('roles', [RolesController::class, 'index'])->name('roles');
    Route::post('roles', [RolesController::class,'store'])->name('roles.store');
    Route::delete('roles/{rol}', [RolesController::class, 'destroy'])->name('roles.destroy');

    Route::resource('usuarios', UsuariosController::class);

    Route::get('clases', [ClasesController::class, 'index'])->name('clases');
    Route::post('clases', [ClasesController::class,'store'])->name('clases.store');
    Route::delete('clases/{clase}', [ClasesController::class, 'destroy'])->name('clases.destroy');
    Route::put('clases/{clase}', [ClasesController::class, 'update'])->name('clases.update');

    Route::get('users.users', [UsuariosController::class, 'index'])->name('users');
    Route::resource('users', UsuariosController::class);
});
