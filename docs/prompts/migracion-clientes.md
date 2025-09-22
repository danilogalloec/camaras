# Proceso de Creación de Tablas y Solución de Errores de Migración

## Objetivo
Crear las tablas `clientes`, `visitas` y `equipos` en la base de datos MySQL usando migraciones de Laravel, sin conocimientos previos de programación.

## Pasos Ejecutados

### 1. Creación de la Migración para Clientes

php artisan make:migration create_clientes_table

**Archivo generado:** `database/migrations/2025_09_20_031304_create_clientes_table.php`

### 2. Definición de la Estructura de la Tabla Clientes
Se editó el archivo de migración para definir los campos:
* `cedula` (string, único)
* `nombre` (string)
* `telefono` (string)
* `correo` (string)
* `direccion` (string)
* `fecha_instalacion` (date)
* `num_equipos` (integer, default 0)
* `tiempo_garantia_meses` (integer, default 12)
* `password` (string)
* `primer_login` (boolean, default true)

### 3. Ejecución de la Migración
php artisan migrate

### 4. Problema Encontrado
Error: SQLSTATE[42S01]: Base table or view already exists: 1050 Table 'clientes' already exists

### 5. Solución Aplicada
* Se listaron las migraciones existentes:
ls database/migrations/

* Se identificó una migración duplicada: 
2025_09_20_023311_create_clientes_table.php.

* Se eliminó la migración duplicada:
rm database/migrations/2025_09_20_023311_create_clientes_table.php

Se ejecutó migrate:fresh para empezar de cero:
php artisan migrate:fresh --force

### 6. Creación de la Tabla Equipos

php artisan make:migration create_equipos_table --create=equipos

### 7. Problema con el Campo 'serie'

En la vista create.blade.php, se usaba el campo serie, pero en la migración se definió como numero_serie.

* **Solución:**
Se actualizó el controlador y la vista para usar numero_serie en lugar de serie.

### 8. Problema con la Ruta Faltante
Al intentar acceder a admin/clientes/{cliente}/equipos/create, se obtuvo un error porque la ruta no estaba definida.

* **Solución:**
Se añadió la ruta en routes/web.php:
Route::get('/admin/clientes/{cliente}/equipos/create', [AdminController::class, 'createEquipo'])->name('admin.clientes.equipos.create');

### 9. Lección Aprendida de los PDFs
Nunca usar --create si la tabla ya existe. Para modificar una tabla existente, usar --table.
