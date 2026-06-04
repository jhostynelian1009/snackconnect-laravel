<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// Bloque 1 (DEV-FRONT): Rutas de inicio, catálogo y checkout
// ==========================================

Route::get('/', function () {
    return view('welcome');
});

// Cart and WhatsApp Checkout Routes
Route::get('/cart', [WhatsAppController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{id}', [WhatsAppController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [WhatsAppController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [WhatsAppController::class, 'clearCart'])->name('cart.clear');
Route::post('/checkout/whatsapp', [WhatsAppController::class, 'checkoutWhatsApp'])->name('checkout.whatsapp');

// ==========================================
// Bloque 2 (DEV-AUTH): Rutas de login, registro y logout
// ==========================================
// (Permanecerán comentadas/vacías para evitar conflictos)

// ==========================================
// Bloque 3 (DEV-DASH / DEV-PROD): Prefijo /admin
// ==========================================
// (Permanecerán comentadas/vacías para evitar conflictos)
