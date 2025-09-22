<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📸 Cámaras Daganet

Aplicación web desarrollada en **Laravel 10 + TailwindCSS + MySQL** para la gestión integral de clientes que compran cámaras IP / DVR y servicios relacionados.

---

## 🌟 Propósito

Centralizar en una sola plataforma:
- Gestión de **clientes** y sus datos de contacto.
- Registro de **equipos** instalados y seguimiento de garantías.
- Creación de **cotizaciones** con cálculo de impuestos en tiempo real y exportación a PDF.
- **Agendamiento de visitas técnicas** desde el perfil del cliente.
- Generación de **reportes** de clientes, equipos y garantías.

---

## ⚙️ Arquitectura de la aplicación

- **Backend:** PHP 8.1, Laravel 10.
- **Frontend:** Blade templates + TailwindCSS + Vite.
- **Base de datos:** MySQL/MariaDB.
- **Servidor:** Ubuntu 22.04 (Hetzner VPS).
- **Autenticación:** Guards `admin` y `cliente` con middleware dedicado.
- **Notificaciones:** Envío de correos (visitas y alertas de garantía).

---

## 📂 Estructura completa del proyecto

```bash
camaras-app/
├─ app/
│  ├─ Console/Commands/EnviarAlertasGarantia.php
│  ├─ Http/
│  │   ├─ Controllers/
│  │   │   ├─ Admin/{ClienteController.php, CotizacionController.php}
│  │   │   ├─ {AdminController.php, AuthAdminController.php, ClienteController.php,
│  │   │       ClienteReporteController.php, CotizacionController.php,
│  │   │       EquipoController.php, ReporteController.php, VisitaController.php}
│  │   ├─ Middleware/{AdminAuth.php, ClienteAuth.php, …}
│  │   └─ Kernel.php
│  ├─ Mail/{AlertaGarantiaMail.php, NuevaVisitaMail.php}
│  ├─ Models/{Admin.php, Cliente.php, Cotizacion.php, CotizacionItem.php, Equipo.php, Visita.php, User.php}
│  └─ Providers/{AppServiceProvider.php, AuthServiceProvider.php, …}
│
├─ resources/
│  ├─ css/app.css
│  ├─ js/{app.js, bootstrap.js}
│  └─ views/
│     ├─ layouts/{app.blade.php, admin.blade.php}
│     ├─ auth/{login.blade.php, admin_login.blade.php}
│     ├─ admin/
│     │   ├─ dashboard.blade.php
│     │   ├─ clientes/{index.blade.php, create.blade.php, nuevo.blade.php, show.blade.php}
│     │   ├─ equipos/{index.blade.php, create.blade.php, edit.blade.php}
│     │   ├─ cotizaciones/{index.blade.php, create.blade.php, edit.blade.php, show.blade.php, pdf.blade.php}
│     │   ├─ visitas/index.blade.php
│     │   └─ reportes/index.blade.php
│     ├─ cliente/{dashboard.blade.php, agendar_visita.blade.php, change-password.blade.php, reportes/index.blade.php}
│     ├─ emails/{alerta_garantia.blade.php, nueva_visita.blade.php}
│     ├─ pdf/cotizacion.blade.php
│     └─ welcome.blade.php
│
├─ database/
│  ├─ migrations/
│  │   ├─ create_clientes_table.php
│  │   ├─ create_equipos_table.php
│  │   ├─ create_visitas_table.php
│  │   ├─ create_admins_table.php
│  │   ├─ create_cotizaciones_table.php
│  │   ├─ create_cotizacion_items_table.php
│  │   └─ … (otras migraciones)
│  └─ seeders/{AdminSeeder.php, DatabaseSeeder.php}
│
├─ routes/{web.php, api.php, console.php, channels.php}
├─ public/{index.php, favicon.ico, robots.txt, build/...}
├─ config/{app.php, auth.php, database.php, mail.php, …}
├─ bootstrap/app.php
├─ artisan
├─ composer.json
├─ package.json
├─ tailwind.config.js
└─ vite.config.js
```
---

## 🖥️ Módulos y funcionalidades
### 1. Autenticación y seguridad

- Guardias admin y cliente.
- Middlewares de protección (AdminAuth, ClienteAuth, VerifyCsrfToken, etc.).
- Variables sensibles en .env (no se suben al repo).

### 2. Clientes

- Alta, edición y ficha detallada.
- Asociación de equipos.
- Agendamiento de visitas.
- Cambio de contraseña.

### 3. Equipos

- CRUD completo (crear, editar, eliminar).
- Relación con clientes.
- Campos de garantía.

### 4. Cotizaciones

- Formulario dinámico con cálculo en tiempo real (subtotal, IVA, total).
- Exportación a PDF (pdf/cotizacion.blade.php).
- Items con cantidad, precio y descuento.

### 5. Visitas técnicas

- Solicitud de visita desde el perfil de cliente.
- Gestión de visitas en el panel admin.
- Envío de correos automáticos (NuevaVisitaMail).

### 6. Reportes

- Resumen de clientes, equipos y garantías.
- Envío de alertas por garantía (EnviarAlertasGarantia.php).

## 🚀 Instalación y despliegue
### Requerimientos

- PHP 8.1+
- MySQL/MariaDB
- Composer
- Node.js y NPM
- TailwindCSS (vía `npm install`)
- Vite (compilador de assets de Laravel)
- Laravel Dompdf (`barryvdh/laravel-dompdf`) para exportar cotizaciones en PDF
- @tailwindcss/forms (plugin de Tailwind para formularios elegantes)

Configura `.env` para base de datos y correo.  
En producción, configura Nginx/Apache y apunta el document root a `public/`.

## 🔒 Seguridad aplicada

- Variables sensibles (`.env`) fuera del repositorio.
- Protección CSRF y validación de datos en todos los formularios.
- Separación de roles (`admin`, `cliente`) con middlewares.
- Notificaciones por correo para eventos críticos (nuevas visitas, vencimiento de garantía).

## 🗂 Documentación y trazabilidad

Toda la historia de desarrollo, decisiones técnicas y prompts se guardan en `docs/` (crear si no existe) con archivos como:

```bash
docs/
├─ decisiones-arquitectura.md
└─ prompts/
    ├─ desarrollo-inicial.md
    ├─ migracion-clientes.md
    └─ analisis-pdfs.md
```

## 📜 Licencia

Por definir según el objetivo del proyecto (MIT sugerida si quieres que sea abierto).
