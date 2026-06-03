# Skill Runbook: Dashboard Administrativo (dashboard_skill)

*   **Responsable:** **DEV-DASH**
*   **Rama Git:** `feature/04-dashboard`
*   **Fase:** CRUD y Panel (Días 5 - 7)

---

## 1. Instrucciones de Implementación
1.  **Crear el controlador administrativo:**
    ```powershell
    php artisan make:controller Admin/DashboardController
    ```
2.  **Implementar consultas dinámicas de métricas en el controlador:**
    *   `Product::count()` (Total de ítems).
    *   `Product::where('status', 'inactive')->count()` (Productos agotados).
    *   `Product::with('category')->latest()->take(5)->get()` (Eager loading para la tabla de últimos agregados, evitando consultas N+1).
3.  **Configurar plantillas base:**
    *   Crear `/resources/views/layouts/admin.blade.php` con la barra lateral de navegación (Sidebar) que incluya enlaces a Dashboard y Productos.
    *   Crear `/resources/views/admin/dashboard.blade.php` extendiendo el layout administrativo.

## 2. Puntos de Control y Verificación
*   [ ] Comprobar que los contadores del Dashboard cambien dinámicamente al registrar o eliminar productos en la base de datos.
*   [ ] Verificar que el sidebar resalte la sección activa correspondiente a la URL en la que se encuentra el usuario.
