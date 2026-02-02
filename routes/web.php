<?php

use Illuminate\Support\Facades\Route;

// 1. Importamos los Controladores (los "cerebros" de cada módulo)
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Cuando entres a la página principal, te redirige a Clientes
Route::get('/', function () {
    return redirect('/clientes'); 
});

// Definimos las rutas automáticas (CRUD) para cada módulo
Route::resource('clientes', ClienteController::class);
Route::resource('productos', ProductoController::class);
Route::resource('proveedores', ProveedorController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('categorias', CategoriaController::class);