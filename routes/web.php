<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AuthController;

// Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página principal
Route::get('/', function () {
    return redirect('/clientes');
});

// Rutas protegidas con autenticación
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('categorias', CategoriaController::class);
});
