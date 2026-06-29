@extends('layouts.admin')

@section('title', 'Movimiento')
@section('breadcrumb', 'Movimiento')

@section('content')
    <div style="margin-bottom:16px;">
        <a href="{{ route('admin.movimientos.index') }}" class="admin-link">← Volver a Movimientos</a>
    </div>

    @if($movimiento)
        <section class="card">
            <h2>Detalle del Movimiento</h2>
            <dl>
                <dt>Fecha</dt><dd>{{ optional($movimiento->created_at)->format('Y-m-d H:i') }}</dd>
                <dt>Producto</dt><dd>{{ optional($movimiento->product)->name ?? '-' }}</dd>
                <dt>Tipo</dt><dd>{{ ucfirst($movimiento->type ?? '-') }}</dd>
                <dt>Cantidad</dt><dd>{{ $movimiento->quantity ?? '-' }}</dd>
                <dt>Usuario</dt><dd>{{ optional($movimiento->user)->name ?? '-' }}</dd>
                <dt>Proveedor</dt><dd>{{ optional($movimiento->provider)->name ?? '-' }}</dd>
                <dt>Motivo</dt><dd>{{ $movimiento->reason ?? '-' }}</dd>
                <dt>Referencia</dt><dd>{{ $movimiento->reference ?? '-' }}</dd>
            </dl>
        </section>
    @else
        <div style="color:var(--color-text-secondary);">Movimiento no encontrado o módulo no integrado aún.</div>
    @endif

@endsection
