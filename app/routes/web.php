<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// === BLOQUE 3: RUTAS ADMIN (DEV-DASH / DEV-PROD) ===
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Movimientos (Module 5) - prepared routes (index, show)
        Route::resource('movimientos', \App\Http\Controllers\Admin\MovimientosController::class)
            ->only(['index', 'show'])
            ->names([ 'index' => 'admin.movimientos.index', 'show' => 'admin.movimientos.show' ]);
});
