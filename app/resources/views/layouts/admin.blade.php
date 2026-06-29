<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel Administrativo SnackConnect - Gestión de snacks y pedidos">
    <title>@yield('title', 'Dashboard') — SnackConnect Admin</title>

    {{-- Tipografía Instrument Sans --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="margin: 0; font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; background: var(--color-bg-base); color: var(--color-text-primary);">

    {{-- ════════════════════════════════════════════════════
         SIDEBAR
         ════════════════════════════════════════════════════ --}}
    <aside class="admin-sidebar" id="admin-sidebar">
        {{-- Logo --}}
        <div class="admin-sidebar-logo">
            <div class="admin-sidebar-logo-icon">S</div>
            <span class="admin-sidebar-logo-text">SnackConnect</span>
        </div>

        {{-- Navigation --}}
        <nav class="admin-sidebar-nav">
            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               aria-label="Dashboard">
                {{-- Heroicon: chart-bar-square --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                </svg>
                <span>Dashboard</span>
            </a>

            {{-- Productos --}}
            <a href="#"
               class="admin-nav-item {{ request()->routeIs('admin.productos.*') ? 'active' : '' }}"
               aria-label="Productos">
                {{-- Heroicon: cube --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
                <span>Productos</span>
            </a>

            {{-- Movimientos (Módulo) --}}
            <a href="{{ route('admin.movimientos.index') }}"
               class="admin-nav-item {{ request()->routeIs('admin.movimientos.*') ? 'active' : '' }}"
               aria-label="Movimientos">
                {{-- Heroicon: arrows-up-down or switch-vertical-like --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5h13.5M3 6.75h13.5M6 3.75v6.75M18 20.25V13.5M21 16.5l-3 3-3-3" />
                </svg>
                <span>Movimientos</span>
            </a>

            {{-- Categorías --}}
            <a href="#"
               class="admin-nav-item"
               aria-label="Categorías">
                {{-- Heroicon: tag --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                <span>Categorías</span>
            </a>

            {{-- Usuarios --}}
            <a href="#"
               class="admin-nav-item"
               aria-label="Usuarios">
                {{-- Heroicon: users --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span>Usuarios</span>
            </a>

            {{-- Separator --}}
            <div class="admin-sidebar-separator"></div>

            {{-- Configuración --}}
            <a href="#"
               class="admin-nav-item"
               aria-label="Configuración">
                {{-- Heroicon: cog-6-tooth --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span>Configuración</span>
            </a>

            {{-- Cerrar Sesión --}}
            <a href="#"
               class="admin-nav-item"
               aria-label="Cerrar Sesión">
                {{-- Heroicon: arrow-right-on-rectangle --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
                <span>Cerrar Sesión</span>
            </a>
        </nav>
    </aside>

    {{-- Sidebar Overlay (Mobile) --}}
    <div class="admin-sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    {{-- ════════════════════════════════════════════════════
         MAIN CONTENT AREA
         ════════════════════════════════════════════════════ --}}
    <div class="admin-main">
        {{-- Navbar Superior --}}
        <header class="admin-navbar">
            <div style="display: flex; align-items: center; gap: var(--space-4);">
                {{-- Hamburger (Mobile) --}}
                <button class="admin-hamburger" id="hamburger-btn" onclick="toggleSidebar()" aria-label="Abrir menú">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                {{-- Breadcrumbs --}}
                <nav class="admin-navbar-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                    <span class="separator">/</span>
                    <span class="current">@yield('breadcrumb', 'Dashboard')</span>
                </nav>
            </div>

            {{-- User Menu --}}
            <div class="admin-navbar-user">
                {{-- Notification Bell --}}
                <button class="admin-hamburger" style="display: flex;" aria-label="Notificaciones">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>

                <div class="admin-navbar-avatar">A</div>
                <div class="admin-navbar-user-info">
                    <span class="admin-navbar-user-name">Admin</span>
                    <span class="admin-navbar-user-role">Administrador</span>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="admin-content">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="admin-footer">
            SnackConnect &copy; {{ date('Y') }} — Todos los derechos reservados. Hecho con 🍕 para la comunidad local.
        </footer>
    </div>

    {{-- ════════════════════════════════════════════════════
         SIDEBAR TOGGLE SCRIPT
         ════════════════════════════════════════════════════ --}}
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');

            // Prevent body scroll when sidebar is open on mobile
            if (sidebar.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // Close sidebar on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('admin-sidebar');
                if (sidebar.classList.contains('open')) {
                    toggleSidebar();
                }
            }
        });

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (window.innerWidth >= 640) {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    </script>
</body>
</html>
