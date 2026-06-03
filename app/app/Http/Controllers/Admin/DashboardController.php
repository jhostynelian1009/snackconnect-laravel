<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra el Dashboard Administrativo con datos mock.
     *
     * Nota: Los datos mock serán reemplazados por consultas Eloquent
     * cuando se integren los modelos Product, User y Pedidos.
     */
    public function index()
    {
        // ── KPI Metrics (Mock) ──
        $metrics = [
            'ventas' => [
                'label' => 'Total Ventas',
                'value' => '$12,450',
                'change' => '+12.5%',
                'direction' => 'up',
                'icon' => 'currency-dollar',
            ],
            'pedidos' => [
                'label' => 'Total Pedidos',
                'value' => '328',
                'change' => '+8.2%',
                'direction' => 'up',
                'icon' => 'shopping-cart',
            ],
            'productos' => [
                'label' => 'Total Productos',
                'value' => '156',
                'change' => '+3',
                'direction' => 'up',
                'icon' => 'cube',
            ],
            'clientes' => [
                'label' => 'Total Clientes',
                'value' => '89',
                'change' => '+5.1%',
                'direction' => 'up',
                'icon' => 'users',
            ],
        ];

        // ── Pedidos Recientes (Mock) ──
        $recentOrders = [
            [
                'id' => '#ORD-2048',
                'cliente' => 'María López',
                'productos' => 'Muffin Chocolate, Galletas',
                'total' => '$8.50',
                'estado' => 'completado',
                'fecha' => 'Hace 15 min',
            ],
            [
                'id' => '#ORD-2047',
                'cliente' => 'Carlos Gutiérrez',
                'productos' => 'Brownie Premium',
                'total' => '$5.00',
                'estado' => 'pendiente',
                'fecha' => 'Hace 32 min',
            ],
            [
                'id' => '#ORD-2046',
                'cliente' => 'Ana Morales',
                'productos' => 'Chips Mixtos, Jugo Natural',
                'total' => '$6.75',
                'estado' => 'completado',
                'fecha' => 'Hace 1 hora',
            ],
            [
                'id' => '#ORD-2045',
                'cliente' => 'Pedro Sánchez',
                'productos' => 'Croissant, Café Latte',
                'total' => '$7.25',
                'estado' => 'pendiente',
                'fecha' => 'Hace 2 horas',
            ],
            [
                'id' => '#ORD-2044',
                'cliente' => 'Laura Jiménez',
                'productos' => 'Donas Glaseadas x3',
                'total' => '$9.00',
                'estado' => 'cancelado',
                'fecha' => 'Hace 3 horas',
            ],
        ];

        // ── Productos Recientes (Mock) ──
        $recentProducts = [
            [
                'id' => 1,
                'nombre' => 'Muffin de Chocolate',
                'categoria' => 'Panadería',
                'precio' => '$3.50',
                'stock' => 24,
                'estado' => 'activo',
            ],
            [
                'id' => 2,
                'nombre' => 'Chips de Vegetales',
                'categoria' => 'Snacks',
                'precio' => '$2.75',
                'stock' => 15,
                'estado' => 'activo',
            ],
            [
                'id' => 3,
                'nombre' => 'Brownie Premium',
                'categoria' => 'Panadería',
                'precio' => '$5.00',
                'stock' => 0,
                'estado' => 'inactivo',
            ],
            [
                'id' => 4,
                'nombre' => 'Jugo Natural Naranja',
                'categoria' => 'Bebidas',
                'precio' => '$2.50',
                'stock' => 30,
                'estado' => 'activo',
            ],
            [
                'id' => 5,
                'nombre' => 'Galletas de Avena',
                'categoria' => 'Snacks',
                'precio' => '$1.80',
                'stock' => 8,
                'estado' => 'activo',
            ],
        ];

        // ── Estadísticas Semanales (Mock) ──
        $weeklyStats = [
            ['day' => 'Lun', 'sales' => 18, 'percent' => 72],
            ['day' => 'Mar', 'sales' => 24, 'percent' => 96],
            ['day' => 'Mié', 'sales' => 15, 'percent' => 60],
            ['day' => 'Jue', 'sales' => 21, 'percent' => 84],
            ['day' => 'Vie', 'sales' => 25, 'percent' => 100],
            ['day' => 'Sáb', 'sales' => 20, 'percent' => 80],
            ['day' => 'Dom', 'sales' => 12, 'percent' => 48],
        ];

        // ── Actividad Reciente (Mock) ──
        $recentActivity = [
            [
                'type' => 'order',
                'text' => '<strong>María López</strong> realizó un nuevo pedido por <strong>$8.50</strong>',
                'time' => 'Hace 15 minutos',
            ],
            [
                'type' => 'product',
                'text' => 'Se agregó <strong>Croissant Integral</strong> al catálogo',
                'time' => 'Hace 45 minutos',
            ],
            [
                'type' => 'user',
                'text' => '<strong>Carlos Gutiérrez</strong> se registró como nuevo cliente',
                'time' => 'Hace 1 hora',
            ],
            [
                'type' => 'alert',
                'text' => '<strong>Brownie Premium</strong> tiene stock agotado',
                'time' => 'Hace 2 horas',
            ],
            [
                'type' => 'order',
                'text' => '<strong>Ana Morales</strong> completó su pedido #ORD-2046',
                'time' => 'Hace 3 horas',
            ],
            [
                'type' => 'product',
                'text' => 'Se actualizó el precio de <strong>Chips de Vegetales</strong>',
                'time' => 'Hace 5 horas',
            ],
        ];

        return view('admin.dashboard', compact(
            'metrics',
            'recentOrders',
            'recentProducts',
            'weeklyStats',
            'recentActivity'
        ));
    }
}
