# Decisiones de Arquitectura – Cámaras Daganet

Este documento resume las decisiones técnicas clave tomadas durante el desarrollo de la aplicación **Cámaras Daganet**, basada en Laravel 10 y TailwindCSS.

---

## 1️⃣ Objetivo del proyecto

Centralizar la administración de clientes que compran cámaras IP/DVR y servicios relacionados:

- Datos de clientes, contactos y garantías.
- Inventario de equipos instalados.
- Cotizaciones dinámicas con generación de PDF.
- Agendamiento de visitas técnicas.
- Reportes y alertas de mantenimiento.

---

## 2️⃣ Stack tecnológico

| Componente       | Tecnología | Razón de elección |
|------------------|-----------|--------------------|
| **Backend**      | Laravel 10 (PHP 8.1) | Framework robusto y de larga vida, con Eloquent ORM y migraciones. |
| **Frontend**     | Blade + TailwindCSS + Vite | Blade permite integración nativa con Laravel; TailwindCSS ofrece un diseño limpio y rápido; Vite mejora la compilación y hot reload. |
| **Base de datos**| MySQL/MariaDB | Amplio soporte en hosting, escalabilidad y rendimiento. |
| **Servidor**     | Ubuntu 22.04 en Hetzner | Estabilidad y soporte de largo plazo. |
| **Correo**       | Zoho Mail + Laravel Mail | Integración confiable para notificaciones (visitas, garantías). |
| **PDF**          | barryvdh/laravel-dompdf | Generación de cotizaciones en PDF. |

---

## 3️⃣ Arquitectura de carpetas y capas

La aplicación sigue el patrón MVC de Laravel:

- `app/Http/Controllers`: lógica de control y endpoints.
- `app/Models`: representación de datos y relaciones.
- `resources/views`: vistas Blade, incluyendo layouts y módulos.
- `routes/web.php`: enrutamiento principal.
- `database/migrations`: estructura de tablas y evolución del esquema.
- `database/seeders`: datos iniciales (administradores, pruebas).
- `public/`: punto de entrada y archivos compilados.

Se utilizó Vite como bundler para compilar CSS y JS de Tailwind de forma óptima en producción.

---

## 4️⃣ Módulos principales

- **Clientes**: CRUD completo, ficha detallada, relación 1:N con equipos y visitas.
- **Equipos**: inventario, campos de garantía, relación con clientes.
- **Cotizaciones**: items dinámicos con cálculo de impuestos y descuentos, exportación en PDF.
- **Visitas técnicas**: agendamiento por el cliente, notificación por correo.
- **Reportes**: métricas de clientes, equipos y vencimientos de garantía.

Cada módulo tiene su controlador, vistas dedicadas y migraciones propias.

---

## 5️⃣ Seguridad

- Variables sensibles en `.env` (fuera del repositorio).
- Middleware `AdminAuth` y `ClienteAuth` para separar roles.
- Protección CSRF en todos los formularios.
- Validación exhaustiva de datos en controladores.
- Uso de `bcrypt` para contraseñas.
- Bloqueo de archivos críticos en `.gitignore`.

---

## 6️⃣ Estilo y UX

- **TailwindCSS** y el plugin `@tailwindcss/forms` para formularios uniformes y responsivos.
- Diseño minimalista y elegante con grid y componentes reutilizables.
- Formulario de cotización con JavaScript nativo para cálculo en tiempo real.

---

## 7️⃣ Flujo de despliegue

1. VPS en Hetzner con Ubuntu 22.04.
2. Servidor web Nginx/Apache apuntando a `public/`.
3. Despliegue GitHub → pull en servidor (`deploy` user).
4. Compilación de assets con `npm run build`.
5. Migraciones y seeders ejecutados con `php artisan migrate --seed`.

---

## 8️⃣ Documentación y trazabilidad

Para mantener la memoria técnica:

- `docs/decisiones-arquitectura.md`: este documento.
- `docs/prompts/`: conversaciones y prompts clave (desarrollo inicial, migración de clientes, análisis de PDFs).
- PDF originales subidos como referencia en `docs/referencias/` (opcional).

---

## 9️⃣ Futuras mejoras

- Integración de tests automáticos con PHPUnit y Laravel Dusk.
- Dashboard con gráficos (por ejemplo, Chart.js) para reportes avanzados.
- Sistema de roles más granular (técnico, soporte).
- API REST/JSON para integraciones externas.

---

**Última actualización:** septiembre 2025
