<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movimiento;

class MovimientosController extends Controller
{
    /**
     * Display a listing of movimientos.
     * Prepared for future filters and Eloquent relationships.
     */
    public function index(Request $request)
    {
        $filters = [
            'producto' => $request->get('producto'),
            'tipo' => $request->get('tipo'),
            'fecha' => $request->get('fecha'),
            'usuario' => $request->get('usuario'),
        ];

        try {
            // Query prepared but executed only if the table exists.
            $query = Movimiento::query()->with(['product', 'user', 'provider']);

            // Filtering placeholders (actual logic to be completed when Inventario available)
            if ($filters['producto']) {
                $query->where('product_id', $filters['producto']);
            }
            if ($filters['tipo']) {
                $query->where('type', $filters['tipo']);
            }
            if ($filters['fecha']) {
                $query->whereDate('created_at', $filters['fecha']);
            }
            if ($filters['usuario']) {
                $query->where('user_id', $filters['usuario']);
            }

            $movimientos = $query->orderByDesc('created_at')->paginate(15);
        } catch (\Throwable $e) {
            // If the movimientos table or related models are not yet present,
            // return an empty collection so the module UI still loads safely.
            $movimientos = collect();
        }

        return view('admin.movimientos.index', compact('movimientos', 'filters'));
    }

    /**
     * Display the specified movimiento.
     */
    public function show($id)
    {
        try {
            $movimiento = Movimiento::with(['product', 'user', 'provider'])->findOrFail($id);
        } catch (\Throwable $e) {
            $movimiento = null;
        }

        return view('admin.movimientos.show', compact('movimiento'));
    }

    // Resource methods create/store/edit/update/destroy intentionally omitted
}
