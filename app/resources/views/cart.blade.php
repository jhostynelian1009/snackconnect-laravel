<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - SnackConnect</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback styles are defined below -->
    @endif
    
    <!-- Inline fallback/extension styles aligned with design-system.md -->
    <style>
        :root {
            --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            --brand-primary: #F53003;
            --brand-primary-hover: #D42802;
            --whatsapp-green: #25D366;
            --whatsapp-green-hover: #128C7E;
        }
        body {
            font-family: var(--font-sans);
        }
        .whatsapp-btn {
            background-color: var(--whatsapp-green);
            transition: all 0.2s ease-in-out;
        }
        .whatsapp-btn:hover {
            background-color: var(--whatsapp-green-hover);
            transform: translateY(-1px);
        }
        .primary-btn {
            background-color: var(--brand-primary);
            transition: all 0.2s ease-in-out;
        }
        .primary-btn:hover {
            background-color: var(--brand-primary-hover);
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen flex flex-col transition-colors duration-200">
    
    <!-- Navigation Bar -->
    <header class="border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- SnackConnect Logo / Identity -->
                <a href="/" class="flex items-center gap-2">
                    <span class="h-8 w-8 rounded-full bg-[#f53003] flex items-center justify-center text-white font-bold text-lg shadow-sm">S</span>
                    <span class="font-bold text-xl tracking-tight text-[#1b1b18] dark:text-white">Snack<span class="text-[#f53003]">Connect</span></span>
                </a>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="/" class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-white transition-colors">
                    Inicio
                </a>
                <span class="h-4 w-px bg-[#e3e3e0] dark:border-[#3E3E3A]"></span>
                <span class="relative inline-flex items-center bg-[#fff2f2] dark:bg-[#1D0002] text-[#f53003] dark:text-[#FF4433] px-3 py-1 rounded-full text-xs font-semibold">
                    Checkout WhatsApp
                </span>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Alerts for feedback -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl border border-green-200 bg-green-50 dark:bg-emerald-950/20 dark:border-emerald-800 text-green-800 dark:text-emerald-400 text-sm flex items-center gap-2 animate-pulse">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl border border-red-200 bg-[#fff2f2] dark:bg-rose-950/20 dark:border-rose-950 text-[#f53003] dark:text-[#FF4433] text-sm flex items-center gap-2">
                <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Cart Items List -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-[#161615] rounded-2xl border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 shadow-sm">
                    <div class="flex items-center justify-between border-b border-[#e3e3e0] dark:border-[#3E3E3A] pb-4 mb-4">
                        <h2 class="text-xl font-bold text-[#1b1b18] dark:text-white flex items-center gap-2">
                            <span>Mi Carrito</span>
                            <span class="text-xs px-2.5 py-0.5 rounded-full bg-[#1b1b18]/10 dark:bg-white/10 text-[#706f6c] dark:text-[#A1A09A]">
                                {{ count($cart) }} {{ count($cart) === 1 ? 'item' : 'items' }}
                            </span>
                        </h2>
                        @if(count($cart) > 0)
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm font-semibold text-[#f53003] hover:underline cursor-pointer">
                                    Vaciar Carrito
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(count($cart) > 0)
                        <div class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                            @foreach($cart as $id => $item)
                                <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="h-16 w-16 rounded-xl object-cover border border-[#e3e3e0] dark:border-[#3E3E3A]" />
                                        <div>
                                            <h3 class="font-semibold text-base text-[#1b1b18] dark:text-white">{{ $item['name'] }}</h3>
                                            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">${{ number_format($item['price'], 2) }} c/u</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between sm:justify-end gap-6">
                                        <!-- Subtotal item -->
                                        <span class="font-bold text-base min-w-[70px] text-right">
                                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </span>
                                        
                                        <!-- Quantity controls -->
                                        <div class="flex items-center gap-1 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-full p-1 bg-gray-50 dark:bg-[#0a0a0a]">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="h-7 w-7 rounded-full flex items-center justify-center text-sm font-bold text-[#706f6c] hover:bg-[#e3e3e0] dark:hover:bg-[#3E3E3A] cursor-pointer">&minus;</button>
                                            </form>
                                            <span class="px-2 font-semibold text-sm">{{ $item['quantity'] }}</span>
                                            <form action="{{ route('cart.add', $id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="h-7 w-7 rounded-full flex items-center justify-center text-sm font-bold text-[#706f6c] hover:bg-[#e3e3e0] dark:hover:bg-[#3E3E3A] cursor-pointer">&plus;</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="py-12 text-center">
                            <div class="h-16 w-16 bg-[#fff2f2] dark:bg-[#1D0002] text-[#f53003] dark:text-[#FF4433] rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-1">El carrito está vacío</h3>
                            <p class="text-[#706f6c] dark:text-[#A1A09A] text-sm mb-6 max-w-md mx-auto">Selecciona tus snacks favoritos del catálogo interactivo de abajo para agregarlos al carrito temporal.</p>
                        </div>
                    @endif
                </div>

                <!-- Mock Catalog Section (For DX testing) -->
                <div class="bg-white dark:bg-[#161615] rounded-2xl border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-[#1b1b18] dark:text-white mb-2">Catálogo de Snacks (Mock Temporal)</h2>
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-6">Agrega snacks para simular la compra antes de integrarlo con la base de datos.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($products as $product)
                            <div class="border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl p-4 flex gap-4 hover:shadow-md transition-all">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-20 w-20 rounded-lg object-cover bg-gray-100" />
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-sm text-[#1b1b18] dark:text-white">{{ $product['name'] }}</h4>
                                        <p class="text-xs text-[#706f6c] dark:text-[#A1A09A] line-clamp-2 mt-0.5">{{ $product['description'] }}</p>
                                    </div>
                                    <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 dark:border-zinc-800">
                                        <span class="font-extrabold text-sm text-[#f53003] dark:text-[#FF4433]">${{ number_format($product['price'], 2) }}</span>
                                        <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="primary-btn text-white text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1 cursor-pointer">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Añadir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Right Side: Order Summary & Checkout Form -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-[#161615] rounded-2xl border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 shadow-sm sticky top-24">
                    <h3 class="text-lg font-bold text-[#1b1b18] dark:text-white mb-4">Resumen del Pedido</h3>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-[#706f6c] dark:text-[#A1A09A]">Subtotal</span>
                            <span class="font-medium">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#706f6c] dark:text-[#A1A09A]">Costo de Envío</span>
                            <span class="text-green-600 dark:text-emerald-400 font-medium">Gratis / WhatsApp Direct</span>
                        </div>
                        <hr class="border-[#e3e3e0] dark:border-[#3E3E3A]" />
                        <div class="flex justify-between items-baseline pt-2">
                            <span class="text-base font-bold">Total Estimado</span>
                            <span class="text-2xl font-black text-[#f53003] dark:text-[#FF4433]">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    @if(count($cart) > 0)
                        <!-- Form to process checkout -->
                        <form action="{{ route('checkout.whatsapp') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div>
                                <label for="customer_name" class="block text-xs font-semibold text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider mb-2">
                                    Nombre Completo *
                                </label>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Ej. Jhostyn Baños" 
                                       class="w-full px-4 py-3 rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-transparent focus:outline-none focus:ring-2 focus:ring-[#f53003] text-sm" 
                                       required />
                                @error('customer_name')
                                    <p class="text-xs text-[#f53003] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider mb-2">
                                    Método de Entrega *
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl p-3 flex flex-col items-center gap-1 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                                        <input type="radio" name="delivery_type" value="llevar" class="accent-[#f53003]" checked />
                                        <span class="text-xs font-medium mt-1">Para Llevar</span>
                                    </label>
                                    <label class="border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl p-3 flex flex-col items-center gap-1 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800/30 transition-colors">
                                        <input type="radio" name="delivery_type" value="local" class="accent-[#f53003]" />
                                        <span class="text-xs font-medium mt-1">Consumo Local</span>
                                    </label>
                                </div>
                                @error('delivery_type')
                                    <p class="text-xs text-[#f53003] mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Checkout via WhatsApp button -->
                            <button type="submit" class="w-full whatsapp-btn text-white font-bold py-3.5 px-4 rounded-xl flex items-center justify-center gap-2 cursor-pointer shadow-md mt-6">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.73-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436.002 9.858-4.42 9.862-9.864.002-2.638-1.023-5.117-2.884-6.979C16.59 1.899 14.116.877 11.48.875c-5.44 0-9.861 4.421-9.864 9.865-.001 1.772.464 3.502 1.346 5.027L1.935 21.8l6.19-1.625c-1.6.945-3.18 1.449-4.82 1.451z"/>
                                </svg>
                                Comprar por WhatsApp
                            </button>
                        </form>
                    @else
                        <!-- Disabled form representation when empty -->
                        <div class="space-y-4">
                            <div class="opacity-50">
                                <label class="block text-xs font-semibold text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider mb-2">Nombre Completo *</label>
                                <input type="text" disabled class="w-full px-4 py-3 rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-transparent text-sm" />
                            </div>
                            <div class="opacity-50">
                                <label class="block text-xs font-semibold text-[#706f6c] dark:text-[#A1A09A] uppercase tracking-wider mb-2">Método de Entrega *</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl p-3 flex flex-col items-center gap-1"><span class="text-xs font-medium">Para Llevar</span></div>
                                    <div class="border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl p-3 flex flex-col items-center gap-1"><span class="text-xs font-medium">Consumo Local</span></div>
                                </div>
                            </div>
                            <button disabled class="w-full bg-[#1b1b18]/10 dark:bg-white/10 text-[#706f6c] dark:text-[#A1A09A] font-bold py-3.5 px-4 rounded-xl flex items-center justify-center gap-2 cursor-not-allowed mt-6">
                                Carrito Vacío
                            </button>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
            <p>&copy; 2026 SnackConnect. Desarrollado con &hearts; por Jhostyn Baños.</p>
        </div>
    </footer>

</body>
</html>
