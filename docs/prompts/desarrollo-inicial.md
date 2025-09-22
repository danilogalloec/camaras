# Historia de Desarrollo - Aplicación de Gestión de Clientes (Cámaras IP)

Este documento registra la evolución técnica del proyecto, las decisiones tomadas, los problemas encontrados y sus soluciones. Sirve como guía para futuros desarrolladores y como registro de trazabilidad para la tesis sobre Vibe Coding con IA.

## 1. Inicio del Proyecto y Elección de Tecnología

*   **Fecha:** 20 de Septiembre de 2025
*   **Prompt Inicial:** El cliente solicitó una aplicación web para gestionar clientes de cámaras IP / DVR / etc., con perfiles de Cliente y Admin, desplegada en un VPS de Hetzner.
*   **Decisión Técnica:** Se eligió **Laravel (PHP)** por su robustez y herramientas como Artisan, ideal para un usuario sin conocimientos de programación que sigue instrucciones paso a paso.
*   **Base de Datos:** **MySQL**.
*   **Entorno:** VPS con Ubuntu 22.04, Nginx, PHP 8.1, MySQL.

## 2. Configuración Inicial del Servidor (VPS)

*   **Acciones:**
    *   Instalación de dependencias: `nginx`, `mysql-server`, `php`, `php-fpm`, `php-mysql`, `composer`.
    *   Creación de la base de datos `camaras_db` y el usuario `camaras_user`.
    *   Configuración de Nginx y obtención de certificado SSL con `certbot`.
*   **Problema Encontrado:** Conflicto de puertos entre Apache2 y Nginx.
*   **Solución Aplicada:** Se detuvo y deshabilitó `apache2`.

## 3. Instalación de Laravel y Estructura Base

*   **Acciones:**
    *   Creación del proyecto: `composer create-project laravel/laravel camaras-app`.
    *   Configuración del archivo `.env`.
    *   Generación de la clave de la aplicación: `php artisan key:generate`.
*   **Problema Encontrado:** El comando `php artisan key:generate` fallaba porque el archivo `.env` no tenía la línea `APP_KEY=`.
*   **Solución Aplicada:** Se agregó manualmente `APP_KEY=` al archivo `.env`.

## 4. Desarrollo del Core: Migraciones, Modelos y Autenticación

### 4.1. Creación de las Tablas (`clientes` y `visitas`)

*   **Acciones:**
    *   Generación de migraciones.
*   **Problema Encontrado:** Error `SQLSTATE[42S01]: Base table or view already exists`.
*   **Solución Aplicada:**
    1.  Se identificaron y eliminaron las migraciones duplicadas usando `rm`.
    2.  Se usó `php artisan migrate:fresh --force` para empezar de cero.

### 4.2. Modelo y Autenticación Personalizada

*   **Acciones:**
    *   Creación del modelo `Cliente` que extiende `Authenticatable` para manejar el login por `cedula`.
    *   Creación del controlador `AuthController`.

### 4.3. Sistema de Login y Middleware

*   **Acciones:**
    *   Creación de la vista `login.blade.php`.
    *   Creación del middleware `ClienteAuth` basado en sesión.
    *   Ajuste de `routes/web.php` para usar middlewares correctos.

## 5. Implementación del Panel de Administrador

*   **Acciones:**
    *   Configuración del guard `admin` en `config/auth.php`.
    *   Creación y ejecución del `AdminSeeder` para crear el usuario `admin@admin.com`.
    *   Corrección del error de login del admin: se cambió el campo `nombre` por `name` en la tabla `admins`.
    *   Reemplazo de la vista `admin/dashboard.blade.php` para que muestre el panel real.

## 6. Implementación de la Sección de Equipos

*   **Acciones:**
    *   Creación de la migración para la tabla `equipos`.
    *   Creación de los modelos `Equipo` y su relación `belongsTo` con `Cliente`.
    *   Creación del controlador `AdminController` con métodos para gestionar equipos.
    *   Creación de las vistas Blade: `index.blade.php`, `create.blade.php`.
    *   **Problemas Resueltos:**
        *   `Unknown column 'serie'`: Se cambió por `numero_serie` en controlador y vista.
        *   `Route [admin.clientes.equipos.create] not defined`: Se añadió la ruta faltante.

## 7. Implementación de la Sección de Cotizaciones

*   **Acciones:**
    *   Creación de las migraciones para `cotizaciones` y `cotizacion_items`.
    *   Creación de los modelos `Cotizacion` y `CotizacionItem`.
    *   Creación del controlador `CotizacionController` con métodos `index`, `create`, `store`.
    *   Creación de las vistas Blade: `create.blade.php`, `index.blade.php`.
    *   **Problemas Resueltos:**
        *   `Undefined array key "cantidad"`: Se corrigió el JavaScript para usar índices incrementales (`items[0][cantidad]`).
        *   `The numero_cotizacion field is required`: Se añadió un campo oculto con valor generado.
        *   `The validez_oferta field must be a valid date`: Se cambió la validación a `numeric` y la columna a `integer`.

## 8. Buenas Prácticas y Decisiones Técnicas Futuras (Basado en PDFs)

*   **Manejo de Migraciones Futuras:**
    *   **Para crear una nueva tabla:** `php artisan make:migration create_nombre_tabla_table --create=nombre_tabla`.
    *   **Para modificar una tabla existente:** `php artisan make:migration add_campo_to_nombre_tabla_table --table=nombre_tabla`.
    *   **Antes de migrar en producción:** Siempre ejecutar `php artisan migrate:status`.
```bash
docs/
├─ HISTORIA_DESARROLLO.md
└─ prompts/
├─ desarrollo-inicial.md
├─ migracion-clientes.md
├─ implementacion-cotizaciones.md
└─ analisis-pdfs.md
```

## 🎓 SALIDA FINAL

Al finalizar, debes entregar:

1. Un **README.md** completo en la raíz del proyecto.
2. La carpeta **`docs/`** con toda la trazabilidad del desarrollo.
3. **Ninguna medida de seguridad adicional** a menos que yo lo solicite.

💡 **Nota Final:** Recuerda que soy un principiante absoluto. Cada instrucción debe ser clara, concisa y asumir cero conocimientos previos.
