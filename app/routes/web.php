<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Bloque 1 (DEV-FRONT): Rutas de inicio, catálogo y checkout
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Bloque 2 (DEV-AUTH): Rutas de login, registro y logout
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Bloque 3 (DEV-DASH): Dashboard Administrativo
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Welcome to the Admin Dashboard (Placeholder)',
            'user' => Auth::user(),
        ]);
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Bloque 3 (DEV-PROD): CRUD Productos y Categorías
|--------------------------------------------------------------------------
|
| Vistas CRUD: @extends('layouts.admin')
| Layout pendiente de integración con DEV-DASH.
| Ver: docs/DEV-PROD-INTEGRACION.md
|
*/
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('categorias', CategoryController::class)
            ->parameters(['categorias' => 'categoria'])
            ->except(['show']);

        Route::resource('productos', ProductController::class)
            ->parameters(['productos' => 'producto'])
            ->except(['show']);
    });