<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

// ============================================
// Bloque 1 — DEV-FRONT (Genesis-Valencia): Landing, Catálogo
// ============================================
Route::get('/', [CatalogController::class, 'landing'])->name('landing');
Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{slug}', [CatalogController::class, 'show'])->name('catalogo.show');

// ============================================
// Bloque 2 — DEV-AUTH: Login, Registro, Logout
// ============================================
// (Pendiente de implementación por DEV-AUTH)

// ============================================
// Bloque 3 — DEV-DASH / DEV-PROD: Prefijo /admin
// ============================================
// (Pendiente de implementación por DEV-DASH y DEV-PROD)
