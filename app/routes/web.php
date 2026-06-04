<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Bloque 3 — DEV-DASH / DEV-PROD
| Prefijo /admin — CRUD Productos y Categorías (Jaider-Tapuyo)
|
| Vistas CRUD: @extends('layouts.admin') — layout pendiente DEV-DASH.
| Ver: docs/DEV-PROD-INTEGRACION.md
| Datos: migraciones + seeders (no database.sqlite en el repo).
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categorias', CategoryController::class)
        ->parameters(['categorias' => 'categoria'])
        ->except(['show']);

    Route::resource('productos', ProductController::class)
        ->parameters(['productos' => 'producto'])
        ->except(['show']);
});
