---

## 📄 5. `docs/prompts/analisis-pdfs.md`

```markdown
# Lecciones Aprendidas de los PDFs de Laravel

## Objetivo
Analizar los PDFs proporcionados sobre buenas prácticas de migraciones en Laravel y aplicar esas lecciones en el desarrollo de la aplicación.

## PDFs Analizados
- `Revisión de PDF Laravel-2.pdf`
- `Revisión de PDF Laravel3.pdf`
- `Revisión de PDF Laravel4.pdf`
- `Migración Laravel clientes.pdf`
- `Análisis de PDFs Laravel-5..pdf`

## Hallazgos Clave

### 1. Evitar Migraciones Duplicadas
**Lección:** Si una tabla (por ejemplo, `equipos`) ya existe en la base de datos, **no** se debe usar `php artisan make:migration create_equipos_table --create=equipos`, porque causará un error `Table already exists`.

**Aplicación en el Proyecto:**
- Se identificó y eliminó una migración duplicada para la tabla `clientes`.
- Se usó `php artisan migrate:fresh --force` para empezar de cero.

### 2. Usar `--table` para Modificar Tablas Existentes
**Lección:** Para agregar columnas, índices o hacer cambios en una tabla que ya existe, se debe usar `--table` en lugar de `--create`.

**Aplicación en el Proyecto:**
- Cuando se necesitó añadir el campo `observaciones` a la tabla `equipos`, se creó una nueva migración con:
    ```bash
    php artisan make:migration add_observaciones_to_equipos_table --table=equipos
    ```

### 3. Revisar el Estado de las Migraciones
**Lección:** Antes de ejecutar migraciones en producción, siempre se debe revisar el estado con `php artisan migrate:status` para saber qué migraciones están pendientes.

**Aplicación en el Proyecto:**
- Se incorporó este comando como parte del checklist antes de cada despliegue.

### 4. Marcar Migraciones como Ejecutadas
**Lección:** Si una tabla fue creada manualmente (por ejemplo, directamente en MySQL) y no hay un registro en la tabla `migrations`, Laravel intentará volver a crearla. Se puede "engañar" a Laravel insertando manualmente un registro en `migrations`.

**Aplicación en el Proyecto:**
- Aunque no se usó esta técnica en este proyecto (se prefirió `migrate:fresh`), se documentó como una opción avanzada para futuros escenarios.

### 5. Buenas Prácticas en Producción
- **Respalda migraciones:** Si se genera una migración por error, respáldala en lugar de borrarla.
    ```bash
    mv database/migrations/2025_09_20_154207_create_equipos_table.php database/migrations/2025_09_20_154207_create_equipos_table.backup.php
    ```
- **Usa `--force`:** En entornos de producción, usa `php artisan migrate --force` para evitar paradas interactivas.

## Conclusión
Estas lecciones fueron fundamentales para evitar errores comunes y para entender cómo Laravel gestiona el estado de la base de datos. Se aplicaron de forma práctica en el desarrollo, lo que permitió una evolución más estable del esquema de la base de datos.
