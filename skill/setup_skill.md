# Skill Runbook: Inicialización del Proyecto (setup_skill)

*   **Responsable:** **Líder Técnico (LT)**
*   **Rama Git:** `feature/00-setup`
*   **Fase:** Cimientos (Día 1 - 2)

---

## 1. Instrucciones de Configuración Inicial
1.  **Ejecutar en la raíz del proyecto para crear la app Laravel:**
    ```powershell
    composer create-project laravel/laravel app
    ```
2.  **Configurar base de datos SQLite:**
    *   Ingresar a `/app` y crear el archivo físico para la base de datos:
        ```powershell
        New-Item -Path "database/database.sqlite" -ItemType "file"
        ```
    *   Editar `app/.env` y establecer:
        ```env
        DB_CONNECTION=sqlite
        # Comentar variables de DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
        ```
3.  **Ejecutar migraciones iniciales de Laravel:**
    ```powershell
    php artisan migrate
    ```

## 2. Puntos de Control y Verificación
*   [ ] Comprobar que `/app/database/database.sqlite` existe y su tamaño es mayor a 0 KB (lo que indica que se crearon las tablas iniciales de Laravel).
*   [ ] Iniciar el servidor local (`php artisan serve`) y verificar la respuesta HTTP 200 en `http://127.0.0.1:8000`.
*   [ ] Integrar e inicializar el repositorio Git local:
    ```powershell
    git init
    git checkout -b develop
    ```
