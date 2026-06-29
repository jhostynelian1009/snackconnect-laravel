@extends('layouts.admin')

@section('title', 'Movimientos')
@section('breadcrumb', 'Movimientos')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h1 style="margin:0;">Movimientos de Inventario</h1>
        <div style="color:var(--color-text-secondary);">Preparado para integración con Inventario</div>
    </div>

    {{-- Filters (UI only) --}}
    <form method="GET" style="display:flex; gap:12px; margin-bottom:16px; flex-wrap:wrap;">
        <select name="producto" aria-label="Filtrar por producto">
            <option value="">Todos los productos</option>
        </select>

        <select name="tipo" aria-label="Filtrar por tipo">
            <option value="">Todos los tipos</option>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>

        <input type="date" name="fecha" aria-label="Filtrar por fecha">

        <select name="usuario" aria-label="Filtrar por usuario">
            <option value="">Todos los usuarios</option>
        </select>

        <button type="submit" class="btn" style="padding:8px 12px;">Filtrar</button>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="admin-table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Usuario</th>
                    <th>Proveedor</th>
                    <th>Motivo</th>
                    <th>Referencia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($movimientos as $mov)
                    <tr>
                        <td>{{ optional($mov->created_at)->format('Y-m-d H:i') ?? '-' }}</td>
                        <td>{{ optional($mov->product)->name ?? optional($mov->product)->title ?? '-' }}</td>
                        <td>{{ ucfirst($mov->type ?? '-') }}</td>
                        <td>{{ $mov->quantity ?? '-' }}</td>
                        <td>{{ optional($mov->user)->name ?? '-' }}</td>
                        <td>{{ optional($mov->provider)->name ?? '-' }}</td>
                        <td>{{ $mov->reason ?? '-' }}</td>
                        <td>{{ $mov->reference ?? '-' }}</td>
                        <td>
                            @if($mov)
                                <a href="{{ route('admin.movimientos.show', [$mov->id]) }}" class="admin-link">Ver</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center; color:var(--color-text-secondary);">No hay movimientos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
