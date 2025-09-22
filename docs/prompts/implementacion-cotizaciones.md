## 📄 4. `docs/prompts/implementacion-cotizaciones.md`

# Diseño, Errores y Solución del Módulo de Cotizaciones

## Objetivo
Implementar un módulo para que los administradores puedan crear cotizaciones con ítems dinámicos, cálculo automático de totales y exportación a PDF.

---

## Pasos Ejecutados

### 1. Creación de las Migraciones
```bash
php artisan make:migration create_cotizaciones_table --create=cotizaciones
php artisan make:migration create_cotizacion_items_table --create=cotizacion_items
```

### 2. Definición de las Tablas
* **`cotizaciones`**:
    * `numero_cotizacion` (string, único)
    * `nombre`, `cedula`, `direccion`, `correo`, `celular`
    * `validez_oferta` (integer, en días)
    * `subtotal`, `impuesto`, `total` (decimal)
    * `notas`, `condiciones` (text)
    * `estado` (string, default 'pendiente')
* **`cotizacion_items`**:
    * `cotizacion_id` (foreign key)
    * `item` (string)
    * `cantidad` (integer)
    * `precio` (decimal)
    * `descuento` (decimal)
    * `total` (decimal)

### 3. Creación de los Modelos
* **`Cotizacion.php`**: Con relación `hasMany` a `CotizacionItem`.
* **`CotizacionItem.php`**: Con relación `belongsTo` a `Cotizacion`.

### 4. Creación del Controlador
* **Archivo**: `app/Http/Controllers/CotizacionController.php`
* **Métodos**: `index`, `create`, `store`.

---

## Problemas Encontrados y Soluciones

### Problema 1: `Undefined array key "cantidad"`
* **Causa:** El formulario enviaba los datos de los ítems sin índices (`items[][cantidad]`), lo que dificultaba el acceso en el backend.
* **Solución:** Se corrigió el JavaScript para que genere índices numéricos para cada ítem dinámico.
    ```javascript
    let index = 0;
    // Al añadir un nuevo ítem:
    let newRow = `
        ...
        <input type="text" name="items[${index}][cantidad]" ...>
        ...
    `;
    index++;
    ```

### Problema 2: `The numero_cotizacion field is required`
* **Causa:** El campo `numero_cotizacion` se generaba en el backend, pero la validación lo requería desde el formulario.
* **Solución:** Se añadió un campo oculto en el formulario para generar y enviar un número de cotización temporal.
    ```html
    <input type="hidden" name="numero_cotizacion" value="COT-{{ Str::random(5) }}">
    ```

### Problema 3: `The validez_oferta field must be a valid date`
* **Causa:** El tipo de dato en la migración (`date`) no coincidía con el dato que se quería guardar (un número de días, `integer`).
* **Solución:**
    1.  Se cambió el tipo de la columna a `integer` en el archivo de la migración.
    2.  Se actualizó la regla de validación en el controlador a `'validez_oferta' => 'required|numeric'`.

---

## Implementación de Exportación a PDF

1.  **Instalación:** Se instaló la librería `barryvdh/laravel-dompdf`.
    ```bash
    composer require barryvdh/laravel-dompdf
    ```
2.  **Implementación:** Se creó el método `exportPdf` en el controlador y se diseñó la vista `pdf.blade.php` para generar el documento.

## Vista Final
La vista `create.blade.php` incluye los siguientes componentes:
* Un formulario para los datos del cliente.
* Una tabla dinámica para los ítems, con botones para añadir y eliminar filas con JavaScript.
* Campos ocultos para `subtotal`, `impuesto` y `total` que se actualizan en tiempo real.
* Un botón para guardar la cotización.
