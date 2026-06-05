<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Bloque 1 (DEV-FRONT): Landing, Catálogo y Checkout
|--------------------------------------------------------------------------
*/
Route::get('/', [CatalogController::class, 'landing'])->name('landing');

Route::get('/catalogo', [CatalogController::class, 'index'])
    ->name('catalogo.index');

Route::get('/catalogo/{slug}', [CatalogController::class, 'show'])
    ->name('catalogo.show');

/*
|--------------------------------------------------------------------------
| Bloque 2 (DEV-AUTH): Login, Registro y Logout
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| Bloque 2.5 (DEV-FRONT): Carrito y WhatsApp Checkout
|--------------------------------------------------------------------------
*/
Route::get('/cart', [WhatsAppController::class, 'showCart'])
    ->name('cart.show');

Route::post('/cart/add/{id}', [WhatsAppController::class, 'addToCart'])
    ->name('cart.add');

Route::post('/cart/remove/{id}', [WhatsAppController::class, 'removeFromCart'])
    ->name('cart.remove');

Route::post('/cart/clear', [WhatsAppController::class, 'clearCart'])
    ->name('cart.clear');

Route::post('/checkout/whatsapp', [WhatsAppController::class, 'checkoutWhatsApp'])
    ->name('checkout.whatsapp');

/*
|--------------------------------------------------------------------------
| Bloque 3 (DEV-DASH): Dashboard Administrativo
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');
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