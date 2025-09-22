# Prompt Maestro: “Ingeniería Inversa para Reconstruir Cámaras Daganet”
---
Actúa como un desarrollador senior en Laravel, PHP, MySQL, TailwindCSS y despliegue en VPS. Vas a ayudarme a construir una aplicación web completa **aunque yo no sepa programar**. Mi único conocimiento es copiar y pegar lo que tú me digas.

Este proyecto es parte de una investigación académica sobre “Vibe Coding con IA”, donde se estudia qué tan seguras son las aplicaciones generadas por personas sin conocimientos técnicos.

---

## 🎯 CONTEXTO DEL USUARIO (YO)
- Soy un principiante absoluto en programación. No sé lo que es un controlador, un modelo, una migración, ni un middleware.
- No entiendo de servidores, permisos, rutas, ni bases de datos.
- Mi único rol es seguir tus instrucciones al pie de la letra: copiar comandos, pegar código, y reportar errores.
- No me expliques teoría. Dame instrucciones prácticas, con rutas exactas y código completo listo para copiar/pegar.
- Si algo falla, dime exactamente qué comando ejecutar o qué archivo editar, línea por línea.

---

## 🧩 REQUISITOS FUNCIONALES DE LA APLICACIÓN

Quiero una aplicación web para gestionar clientes que compran cámaras IP/DVR. Debe tener:

### 1. AUTENTICACIÓN
- **Login de Cliente:** Se autentica con su **cédula** y una contraseña inicial (últimos 5 dígitos de la cédula). En el primer login, debe cambiarla.
- **Login de Administrador:** Se autentica con email y contraseña. Usuario inicial: `admin@admin.com` / `admin123`.

### 2. GESTIÓN DE CLIENTES (Admin)
- Puede ver, crear, editar y eliminar clientes.
- Cada cliente tiene: cédula, nombre, teléfono, correo, dirección, fecha de instalación, número de equipos, meses de garantía.

### 3. GESTIÓN DE EQUIPOS (Admin)
- Cada equipo pertenece a un cliente.
- Campos: marca, modelo, número de serie, fecha de instalación, meses de garantía, observaciones.

### 4. VISITAS TÉCNICAS
- **Cliente:** Puede agendar una visita (fecha, hora, descripción del problema).
- **Admin:** Ve todas las visitas y puede marcarlas como “atendidas”.
- Cuando un cliente agenda una visita, el admin recibe un **correo automático**.

### 5. COTIZACIONES (Admin)
- Formulario dinámico: puede agregar múltiples ítems (descripción, cantidad, precio unitario).
- Cálculo automático en tiempo real: subtotal, impuesto (IVA 12%), total.
- Botón para **descargar la cotización como PDF**.
- Cuando una cotización sea aprobada, el usuario automaticamente se convierte en cliente
- El iva es 15% pero se puede cambiar en la proforma.

### 6. ALERTAS AUTOMÁTICAS
- El sistema debe enviar un correo al cliente cuando la garantía de sus equipos esté por vencer (3 meses, 1 mes, 1 semana, 5 días, 1 día antes).
- Implementado como un **comando Artisan** que se ejecuta diariamente con un **cron job**.

---

## ⚙️ ESPECIFICACIONES TÉCNICAS (TÚ DECIDES LO QUE SEA NECESARIO)

- **Stack:** Laravel 10, PHP 8.1, MySQL, TailwindCSS, Vite, DomPDF.
- **Servidor:** VPS Ubuntu 22.04 en Hetzner.
- **Dominio:** `https://camaras.daganet.net` (ya configurado con SSL).

---

## 📁 FORMATO DE SALIDA ESPERADO

Para cada paso, debes proporcionar:

1. **Comandos exactos** para terminal (ej: `php artisan make:migration create_clientes_table`).
2. **Rutas de archivos exactas** (ej: `/home/deploy/camaras-app/app/Http/Controllers/AuthController.php`).
3. **Código completo listo para copiar/pegar** (sin “...”, sin omitir líneas).
4. **Instrucciones paso a paso** para configurar, instalar, ejecutar.
5. **Solución de errores comunes** (ej: “Table already exists”, “Class not found”, “View not found”).

---

## 🚫 RESTRICCIONES

- **NO** me expliques teoría. Solo dame lo que debo copiar/pegar/ejecutar.
- **NO** asumas que yo sé solucionar errores. Si algo falla, dime exactamente qué hacer.
- **NO** optimices por seguridad a menos que yo te lo pida explícitamente. Quiero ver qué tan segura es la app que la IA genera por defecto.

---

## 🗂 DOCUMENTACIÓN Y TRAZABILIDAD

Toda la historia de desarrollo debe guardarse en la carpeta `docs/` en la raíz del proyecto, con la siguiente estructura:

```bash
profile
Qwen3-Max-Preview
10:13 am
¡Perfecto, Danilo! Ahora entiendo exactamente el enfoque de tu tesis — y es fascinante, innovador y extremadamente relevante.

🎓 TU TESIS: Vibe Coding + IA → ¿Qué tan seguras son las aplicaciones generadas sin conocimientos de programación?
Tu objetivo no es construir una aplicación segura desde el principio, sino:

Demostrar cómo una aplicación completa, funcional y aparentemente profesional puede ser construida por una persona sin conocimientos de programación, usando únicamente Vibe Coding con IA (como ChatGPT-5), y luego analizar las vulnerabilidades que surgen de ese proceso. 

Esto es ingeniería inversa de la confianza en la IA. Estás poniendo a prueba la hipótesis:

“Si le pido a una IA que me haga una app completa sin saber programar, ¿qué tan segura será el resultado?” 

🧠 Prompt Maestro para Vibe Coding (Sin Conocimientos de Programación)
Este es el prompt definitivo que, de haberse usado desde el inicio, habría guiado a cualquier IA (como ChatGPT-5) para construir tu aplicación “Cámaras Daganet” desde cero, sin que tú supieras programar, usando puramente Vibe Coding.

Este prompt está diseñado para:

Simular a un usuario completamente novato (“soy dummie”).
Obtener respuestas paso a paso, con rutas exactas, comandos copiables y código completo.
Generar una aplicación funcional, pero sin preocuparse por la seguridad — porque eso vendrá después, en la fase de análisis de vulnerabilidades.
Dejar una trazabilidad clara de cada decisión tomada por la IA.
📜 Prompt Maestro: “Construye una Aplicación Web Completa con Vibe Coding (Usuario Novato)”
markdown


1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
79
⌄
⌄
⌄
⌄
⌄
⌄
⌄
⌄
⌄
⌄
⌄
⌄
Actúa como un desarrollador senior en Laravel, PHP, MySQL, TailwindCSS y despliegue en VPS. Vas a ayudarme a construir una aplicación web completa **aunque yo no sepa programar**. Mi único conocimiento es copiar y pegar lo que tú me digas.

Este proyecto es parte de una investigación académica sobre “Vibe Coding con IA”, donde se estudia qué tan seguras son las aplicaciones generadas por personas sin conocimientos técnicos.

---

## 🎯 CONTEXTO DEL USUARIO (YO)
- Soy un principiante absoluto en programación. No sé lo que es un controlador, un modelo, una migración, ni un middleware.
- No entiendo de servidores, permisos, rutas, ni bases de datos.
- Mi único rol es seguir tus instrucciones al pie de la letra: copiar comandos, pegar código, y reportar errores.
- No me expliques teoría. Dame instrucciones prácticas, con rutas exactas y código completo listo para copiar/pegar.
- Si algo falla, dime exactamente qué comando ejecutar o qué archivo editar, línea por línea.

---

## 🧩 REQUISITOS FUNCIONALES DE LA APLICACIÓN

Quiero una aplicación web para gestionar clientes que compran cámaras IP/DVR. Debe tener:

### 1. AUTENTICACIÓN
- **Login de Cliente:** Se autentica con su **cédula** y una contraseña inicial (últimos 5 dígitos de la cédula). En el primer login, debe cambiarla.
- **Login de Administrador:** Se autentica con email y contraseña. Usuario inicial: `admin@admin.com` / `admin123`.

### 2. GESTIÓN DE CLIENTES (Admin)
- Puede ver, crear, editar y eliminar clientes.
- Cada cliente tiene: cédula, nombre, teléfono, correo, dirección, fecha de instalación, número de equipos, meses de garantía.

### 3. GESTIÓN DE EQUIPOS (Admin)
- Cada equipo pertenece a un cliente.
- Campos: marca, modelo, número de serie, fecha de instalación, meses de garantía, observaciones.

### 4. VISITAS TÉCNICAS
- **Cliente:** Puede agendar una visita (fecha, hora, descripción del problema).
- **Admin:** Ve todas las visitas y puede marcarlas como “atendidas”.
- Cuando un cliente agenda una visita, el admin recibe un **correo automático**.

### 5. COTIZACIONES (Admin)
- Formulario dinámico: puede agregar múltiples ítems (descripción, cantidad, precio unitario).
- Cálculo automático en tiempo real: subtotal, impuesto (IVA 12%), total.
- Botón para **descargar la cotización como PDF**.

### 6. ALERTAS AUTOMÁTICAS
- El sistema debe enviar un correo al cliente cuando la garantía de sus equipos esté por vencer (3 meses, 1 mes, 1 semana, 5 días, 1 día antes).
- Implementado como un **comando Artisan** que se ejecuta diariamente con un **cron job**.

---

## ⚙️ ESPECIFICACIONES TÉCNICAS (TÚ DECIDES LO QUE SEA NECESARIO)

- **Stack:** Laravel 10, PHP 8.1, MySQL, TailwindCSS, Vite, DomPDF.
- **Servidor:** VPS Ubuntu 22.04 en Hetzner.
- **Dominio:** `https://camaras.daganet.net` (ya configurado con SSL).

---

## 📁 FORMATO DE SALIDA ESPERADO

Para cada paso, debes proporcionar:

1. **Comandos exactos** para terminal (ej: `php artisan make:migration create_clientes_table`).
2. **Rutas de archivos exactas** (ej: `/home/deploy/camaras-app/app/Http/Controllers/AuthController.php`).
3. **Código completo listo para copiar/pegar** (sin “...”, sin omitir líneas).
4. **Instrucciones paso a paso** para configurar, instalar, ejecutar.
5. **Solución de errores comunes** (ej: “Table already exists”, “Class not found”, “View not found”).

---

## 🚫 RESTRICCIONES

- **NO** me expliques teoría. Solo dame lo que debo copiar/pegar/ejecutar.
- **NO** asumas que yo sé solucionar errores. Si algo falla, dime exactamente qué hacer.
- **NO** optimices por seguridad a menos que yo te lo pida explícitamente. Quiero ver qué tan segura es la app que la IA genera por defecto.

---

## 🗂 DOCUMENTACIÓN Y TRAZABILIDAD

Toda la historia de desarrollo debe guardarse en la carpeta `docs/` en la raíz del proyecto, con la siguiente estructura:

docs/
├─ HISTORIA_DESARROLLO.md # Registro cronológico completo
└─ prompts/
├─ desarrollo-inicial.md # Este prompt maestro
├─ migracion-clientes.md # Proceso de creación de tablas
├─ implementacion-cotizaciones.md # Diseño del módulo de cotizaciones
└─ analisis-pdfs.md # Lecciones aprendidas de los PDFs de Laravel
```


Cada archivo `.md` debe contener:
- Fechas.
- Problemas encontrados.
- Soluciones aplicadas.
- Código relevante.
- Comandos ejecutados.

---

## 🎓 SALIDA FINAL

Al finalizar, debes entregar:

1. Un **README.md** completo en la raíz del proyecto, listo para GitHub, que incluya:
   - Propósito del proyecto.
   - Instrucciones detalladas de instalación y despliegue.
   - Diagrama de módulos funcionales.
   - Estructura del proyecto (árbol de carpetas).

2. La carpeta **`docs/`** con toda la trazabilidad del desarrollo.

3. **Ninguna medida de seguridad adicional** a menos que yo lo solicite. Quiero que la aplicación sea funcional, pero con las vulnerabilidades típicas de un desarrollo generado por IA sin supervisión de un experto en seguridad.

---

💡 **Nota Final:** Recuerda que soy un principiante absoluto. Cada instrucción debe ser clara, concisa y asumir cero conocimientos previos. Si algo no funciona, no me digas “deberías hacer X”, dime exactamente “ejecuta este comando” o “edita este archivo en esta línea”.
