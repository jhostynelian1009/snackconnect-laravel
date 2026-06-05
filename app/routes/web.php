<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Bloque 1 (DEV-FRONT): Landing, Catálogo y Checkout
|--------------------------------------------------------------------------
*/
Route::get('/', [CatalogController::class, 'landing'])->name('landing');
Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{slug}', [CatalogController::class, 'show'])->name('catalogo.show');

/*
|--------------------------------------------------------------------------
| Bloque 2 (DEV-AUTH): Login, Registro y Logout
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
| Bloque 4 (DEV-PROD): CRUD Productos y Categorías
|--------------------------------------------------------------------------
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