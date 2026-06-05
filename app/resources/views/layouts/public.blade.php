<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SnackConnect — Tus snacks favoritos, directo a tu WhatsApp. Catálogo de snacks artesanales con pedido directo.">
    <title>@yield('title', 'SnackConnect — Tus snacks favoritos')</title>

    {{-- Tipografía oficial: Instrument Sans (design-system.md §3) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg-base text-text-primary font-sans antialiased min-h-screen flex flex-col">

    {{-- ========================================== --}}
    {{-- Navbar Pública (ui-components.md §1.1)     --}}
    {{-- ========================================== --}}
    <nav class="sticky top-0 z-50 bg-bg-base border-b border-border-default" id="navbar-public">
        <div class="max-w-7xl mx-auto px-5 flex items-center justify-between h-14 md:h-16">
            {{-- Logo (branding.md §2.1) --}}
            <a href="{{ route('landing') }}" class="text-xl font-semibold text-text-primary tracking-tight hover:opacity-80 transition-opacity">
                SnackConnect
            </a>

            {{-- Links Desktop --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('catalogo.index') }}"
                   class="text-sm font-medium text-text-primary hover:border-b hover:border-border-strong pb-0.5 transition-all">
                    Catálogo
                </a>
                {{-- Login/Register: responsabilidad DEV-AUTH --}}
                <a href="#" class="sc-btn sc-btn-secondary text-sm">Iniciar Sesión</a>
            </div>

            {{-- Hamburger Mobile --}}
            <button id="mobile-menu-btn" class="md:hidden p-2 text-text-primary" aria-label="Abrir menú">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-border-default bg-bg-base px-5 py-4 space-y-3">
            <a href="{{ route('catalogo.index') }}" class="block text-sm font-medium text-text-primary py-2">Catálogo</a>
            <a href="#" class="block text-sm font-medium text-text-secondary py-2">Iniciar Sesión</a>
        </div>
    </nav>

    {{-- ========================================== --}}
    {{-- Contenido Principal                        --}}
    {{-- ========================================== --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ========================================== --}}
    {{-- Footer Público (branding.md §6.3)          --}}
    {{-- ========================================== --}}
    <footer class="bg-bg-surface border-t border-border-default" id="footer-public">
        <div class="max-w-7xl mx-auto px-5 py-8 text-center">
            <p class="text-[13px] text-text-secondary">
                SnackConnect &copy; {{ date('Y') }} &mdash; Todos los derechos reservados.
            </p>
            <p class="text-[13px] text-text-secondary mt-1">
                Hecho con 🍕 para la comunidad local.
            </p>
        </div>
    </footer>

    {{-- Mobile menu toggle --}}
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
            const icon = this.querySelector('svg');
            if (menu.classList.contains('hidden')) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>';
            }
        });
    </script>
</body>
</html>
