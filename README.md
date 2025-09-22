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

camaras-app/
├─ .editorconfig
├─ .env.example
├─ .gitattributes
├─ .gitignore
├─ README.md
├─ artisan
├─ composer.json
├─ composer.lock
├─ package.json
├─ package-lock.json
├─ phpunit.xml
├─ postcss.config.cjs
├─ tailwind.config.js
├─ vite.config.js
├─ bootstrap/
│  ├─ app.php
│  └─ cache/.gitignore
├─ config/
│  ├─ app.php
│  ├─ auth.php
│  ├─ broadcasting.php
│  ├─ cache.php
│  ├─ cors.php
│  ├─ database.php
│  ├─ dompdf.php
│  ├─ filesystems.php
│  ├─ hashing.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ sanctum.php
│  ├─ services.php
│  ├─ session.php
│  └─ view.php
├─ public/
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ index.php
│  ├─ robots.txt
│  └─ build/
│     ├─ assets/
│     │  ├─ app-AB96g9ka.js
│     │  ├─ app-CksuuEqD.css
│     │  └─ app-DTTGfVdl.css
│     └─ manifest.json
├─ resources/
│  ├─ css/app.css
│  ├─ js/
│  │  ├─ app.js
│  │  └─ bootstrap.js
│  └─ views/
│     ├─ layouts/
│     │  ├─ app.blade.php
│     │  └─ admin.blade.php
│     ├─ auth/
│     │  ├─ admin_login.blade.php
│     │  └─ login.blade.php
│     ├─ admin/
│     │  ├─ dashboard.blade.php
│     │  ├─ dashboard.blade.php-bueno          (backup)
│     │  ├─ dashboard.blade.php.save           (backup)
│     │  ├─ clientes.blade.php                 (vista legacy/atajo)
│     │  ├─ editar_cliente.blade.php
│     │  ├─ clientes/
│     │  │  ├─ create.blade.php
│     │  │  ├─ index.blade.php
│     │  │  ├─ show.blade.php
│     │  │  ├─ nuevo.blade.php
│     │  │  └─ nuevo.blade.php-bk              (backup)
│     │  ├─ equipos.blade.php                  (vista legacy/atajo)
│     │  ├─ equipos/
│     │  │  ├─ create.blade.php
│     │  │  ├─ edit.blade.php
│     │  │  └─ index.blade.php
│     │  ├─ cotizaciones/
│     │  │  ├─ create.blade.php
│     │  │  ├─ edit.blade.php
│     │  │  ├─ index.blade.php
│     │  │  ├─ pdf.blade.php
│     │  │  └─ show.blade.php
│     │  ├─ reportes/
│     │  │  └─ index.blade.php
│     │  └─ visitas/
│     │     └─ index.blade.php
│     ├─ cliente/
│     │  ├─ dashboard.blade.php
│     │  ├─ agendar_visita.blade.php
│     │  ├─ change-password.blade.php
│     │  ├─ change_password.blade.php          (variación)
│     │  └─ reportes/index.blade.php
│     ├─ emails/
│     │  ├─ alerta_garantia.blade.php
│     │  └─ nueva_visita.blade.php
│     ├─ pdf/
│     │  └─ cotizacion.blade.php               (plantilla PDF)
│     └─ welcome.blade.php
├─ routes/
│  ├─ web.php
│  ├─ api.php
│  ├─ channels.php
│  └─ console.php
├─ database/
│  ├─ .gitignore
│  ├─ factories/
│  │  └─ UserFactory.php
│  ├─ migrations/
│  │  ├─ 2014_10_12_000000_create_users_table.php
│  │  ├─ 2014_10_12_100000_create_password_reset_tokens_table.php
│  │  ├─ 2019_08_19_000000_create_failed_jobs_table.php
│  │  ├─ 2019_12_14_000001_create_personal_access_tokens_table.php
│  │  ├─ 2025_09_20_031304_create_clientes_table.php
│  │  ├─ 2025_09_20_031909_create_visitas_table.php
│  │  ├─ 2025_09_20_043211_create_equipos_table.php
│  │  ├─ 2025_09_20_054338_create_admins_table.php
│  │  ├─ 2025_09_20_173106_add_campos_extra_to_equipos_table.php
│  │  ├─ 2025_09_21_000400_create_cotizaciones_table.php
│  │  ├─ 2025_09_21_154308_create_cotizacion_items_table.php
│  │  ├─ 2025_09_21_155211_change_validez_oferta_in_cotizaciones_table.php
│  │  └─ 2025_09_21_161017_change_validez_oferta_type_in_cotizaciones_table.php
│  └─ seeders/
│     ├─ AdminSeeder.php
│     └─ DatabaseSeeder.php
└─ app/
   ├─ Console/
   │  ├─ Commands/EnviarAlertasGarantia.php
   │  └─ Kernel.php
   ├─ Exceptions/Handler.php
   ├─ Http/
   │  ├─ Controllers/
   │  │  ├─ Admin/ClienteController.php
   │  │  ├─ Admin/CotizacionController.php
   │  │  ├─ AdminController.php
   │  │  ├─ AuthAdminController.php
   │  │  ├─ AuthController.php
   │  │  ├─ ClienteController.php
   │  │  ├─ ClienteReporteController.php
   │  │  ├─ CotizacionController.php
   │  │  ├─ EquipoController.php
   │  │  ├─ ReporteController.php
   │  │  └─ VisitaController.php
   │  ├─ Middleware/
   │  │  ├─ AdminAuth.php
   │  │  ├─ Authenticate.php
   │  │  ├─ ClienteAuth.php
   │  │  ├─ EncryptCookies.php
   │  │  ├─ PreventRequestsDuringMaintenance.php
   │  │  ├─ RedirectIfAuthenticated.php
   │  │  ├─ TrimStrings.php
   │  │  ├─ TrustHosts.php
   │  │  ├─ TrustProxies.php
   │  │  ├─ ValidateSignature.php
   │  │  └─ VerifyCsrfToken.php
   │  └─ Kernel.php
   ├─ Mail/
   │  ├─ AlertaGarantiaMail.php
   │  └─ NuevaVisitaMail.php
   ├─ Models/
   │  ├─ Admin.php
   │  ├─ Cliente.php
   │  ├─ Cotizacion.php
   │  ├─ CotizacionItem.php
   │  ├─ Equipo.php
   │  ├─ User.php
   │  └─ Visita.php
   └─ Providers/
      ├─ AppServiceProvider.php
      ├─ AuthServiceProvider.php
      ├─ BroadcastServiceProvider.php
      ├─ EventServiceProvider.php
      └─ RouteServiceProvider.php
---

## 🖥️ Módulos y funcionalidades

### 1. Autenticación y seguridad
- Guardias `admin` y `cliente`.
- Middlewares de protección (`AdminAuth`, `ClienteAuth`, `VerifyCsrfToken`, etc.).
- Variables sensibles en `.env` (no se suben al repo).

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
- Exportación a PDF (`pdf/cotizacion.blade.php`).
- Items con cantidad, precio y descuento.

### 5. Visitas técnicas
- Solicitud de visita desde el perfil de cliente.
- Gestión de visitas en el panel admin.
- Envío de correos automáticos (`NuevaVisitaMail`).

### 6. Reportes
- Resumen de clientes, equipos y garantías.
- Envío de alertas por garantía (`EnviarAlertasGarantia.php`).

---

## 🚀 Instalación y despliegue

### Requerimientos
- PHP 8.1+
- MySQL/MariaDB
- Composer
- Node.js y NPM

### Pasos

```bash
git clone https://github.com/danilogalloec/camaras.git
cd camaras
cp .env.example .env
composer install
npm install
npm run build
php artisan key:generate
php artisan migrate --seed

Configura .env para base de datos y correo.
En producción, configura Nginx/Apache y apunta el document root a public/.

🔒 Seguridad aplicada

Variables sensibles (.env) fuera del repositorio.
Protección CSRF y validación de datos en todos los formularios.
Separación de roles (admin, cliente) con middlewares.
Notificaciones por correo para eventos críticos (nuevas visitas, vencimiento de garantía).

🗂 Documentación y trazabilidad

Toda la historia de desarrollo, decisiones técnicas y prompts se guardan en docs/
 (crear si no existe) con archivos como:

docs/
├─ decisiones-arquitectura.md
└─ prompts/
    ├─ desarrollo-inicial.md
    ├─ migracion-clientes.md
    └─ analisis-pdfs.md

📜 Licencia

Por definir según el objetivo del proyecto (MIT sugerida si quieres que sea abierto).
---

### Cómo usarlo

1. En el VPS:
   ```bash
   cd /home/deploy/camaras-app
   nano README.md
