# Esquema de Base de Datos – Cámaras Daganet

Migraciones ejecutadas en producción al 2025-09-21:

| Batch | Migration name |
|-------|----------------|
| 1 | 2014_10_12_000000_create_users_table |
| 1 | 2014_10_12_100000_create_password_reset_tokens_table |
| 1 | 2019_08_19_000000_create_failed_jobs_table |
| 1 | 2019_12_14_000001_create_personal_access_tokens_table |
| 1 | 2025_09_20_031304_create_clientes_table |
| 1 | 2025_09_20_031909_create_visitas_table |
| 1 | 2025_09_20_043211_create_equipos_table |
| 1 | 2025_09_20_054338_create_admins_table |
| 1 | 2025_09_20_173106_add_campos_extra_to_equipos_table |
| 1 | 2025_09_21_000400_create_cotizaciones_table |
| 2 | 2025_09_21_154308_create_cotizacion_items_table |
| 3 | 2025_09_21_155211_change_validez_oferta_in_cotizaciones_table |
| 4 | 2025_09_21_161017_change_validez_oferta_type_in_cotizaciones_table |

---

## Descripción de las tablas principales

- **clientes**  
  Datos de identificación, contacto, fecha de instalación, equipos instalados, tiempo de garantía.
- **equipos**  
  Tipo, marca, modelo, serie, relación con cliente, garantía.
- **visitas**  
  Fecha de visita, comentario del cliente, estado (atendida / pendiente).
- **admins**  
  Usuarios administradores para acceso al panel.
- **cotizaciones**  
  Datos de cliente, validez de oferta, subtotal, impuesto y total.
- **cotizacion_items**  
  Items de cada cotización (descripción, cantidad, precio, descuento).

Además se incluyen las tablas de soporte estándar de Laravel:  
`users`, `password_reset_tokens`, `failed_jobs` y `personal_access_tokens`.

---

## Notas de mantenimiento

- Para agregar campos:  
  ```bash
  php artisan make:migration add_campo_x_to_tabla --table=tabla
  php artisan migrate
- Para verificar el estado:
php artisan migrate:status
- Para verificar el estado:
php artisan migrate:rollback
