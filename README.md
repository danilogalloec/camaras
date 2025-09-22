<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

-----

# **Cámaras Daganet - Sistema de Gestión de Clientes**

Este es un sistema web completo desarrollado para la gestión de clientes, equipos de seguridad (Cámaras IP, DVRs), visitas técnicas y cotizaciones. La aplicación está construida con **Laravel 11** y pensada para ser desplegada en un servidor **VPS de Hetzner con Ubuntu 22.04**.

## **Descripción General**

La plataforma ofrece dos perfiles de usuario con funcionalidades específicas:

  * **Perfil de Cliente:** Permite a los clientes finales consultar la información de sus equipos instalados, el estado de su garantía, solicitar visitas técnicas y actualizar sus datos de contacto.
  * **Perfil de Administrador:** Ofrece un panel de control completo para gestionar clientes, equipos, visitas, y crear cotizaciones detalladas.

## **Tecnologías Utilizadas**

  * **Backend:** PHP 8.1 con **Laravel 11**
  * **Frontend:** Vistas de Blade con **TailwindCSS**
  * **Base de Datos:** **MySQL 8**
  * **Servidor Web:** **Nginx**
  * **Servidor:** VPS en **Hetzner**
  * **Sistema Operativo:** **Ubuntu 22.04 LTS**
  * **Dependencias PHP:** Composer
  * **Dependencias Frontend:** Node.js + npm/Vite
  * **Certificados SSL:** Let's Encrypt (Certbot)

## **Características Principales**

### **Portal del Cliente**

  * **Login Seguro:** Autenticación por cédula y contraseña.
  * **Cambio de Contraseña Obligatorio:** En el primer inicio de sesión, el cliente debe establecer una nueva contraseña.
  * **Dashboard Personalizado:** Visualización de datos personales, fecha de instalación, y garantía.
  * **Gestión de Perfil:** El cliente puede actualizar su número de teléfono, correo y dirección.
  * **Inventario de Equipos:** Listado detallado de los equipos instalados (DVRs, cámaras, etc.).
  * **Solicitud de Soporte:** Formulario para describir problemas técnicos y agendar visitas.
  * **Alertas de Garantía:** Sistema automático de notificaciones por correo electrónico cuando la garantía está por vencer (alertas a los 3 meses, 1 mes, 1 semana, 5 días y 1 día antes).

### **Panel de Administración**

  * **Dashboard de Métricas:** Resumen visual del total de clientes, visitas pendientes y atendidas.
  * **Gestión de Clientes (CRUD):**
      * Crear, editar, listar y eliminar clientes.
      * Buscador de clientes por cédula.
  * **Gestión de Equipos por Cliente:**
      * Añadir, editar y eliminar equipos asociados a cada cliente, especificando tipo, marca, modelo, número de serie y garantía individual.
  * **Gestión de Visitas Técnicas:**
      * Ver el listado de todas las visitas agendadas.
      * Marcar visitas como "Atendidas".
  * **Módulo de Cotizaciones:**
      * Crear cotizaciones personalizadas con datos del cliente.
      * Tabla de ítems dinámica para agregar productos con cantidad, precio, descuento y total.
      * Cálculo automático de subtotal, impuesto (IVA editable) y total.
      * Opción de convertir una cotización aprobada en un nuevo cliente.
      * Generación de PDF para imprimir o enviar por correo.

## **Estructura de la Base de Datos**

La aplicación utiliza las siguientes tablas principales en MySQL:

  * `admins`: Para los usuarios administradores (nombre, email, password).
  * `clientes`: Almacena la información de los clientes (cédula, nombre, contacto, fecha de instalación, etc.).
  * `equipos`: Detalle de cada equipo instalado, relacionado con un cliente.
  * `visitas`: Registro de las solicitudes de visitas técnicas por parte de los clientes.
  * `cotizaciones`: Guarda la información de las cotizaciones generadas.
  * `cotizacion_items`: Almacena los ítems de cada cotización.

## **Guía de Instalación y Despliegue en VPS Hetzner**

Esta guía asume que tienes un VPS nuevo con **Ubuntu 22.04 LTS** y acceso como `root`.

### **1. Preparación del Servidor**

Conéctate a tu servidor por SSH:

```bash
ssh root@TU_IP_DEL_SERVIDOR
```

Actualiza los paquetes del sistema:

```bash
sudo apt update && sudo apt upgrade -y
```

Crea un usuario `deploy` para gestionar la aplicación (por seguridad, no uses `root`):

```bash
sudo adduser deploy
sudo usermod -aG sudo deploy
```

### **2. Instalación de Dependencias (Stack LEMP)**

Instala Nginx, MySQL, PHP y otras herramientas necesarias:

```bash
sudo apt install -y nginx mysql-server php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-zip php8.1-curl composer unzip
```

Instala Node.js y npm (para compilar el frontend):

```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

### **3. Configuración de la Base de Datos MySQL**

Accede a MySQL:

```bash
sudo mysql
```

Crea la base de datos y el usuario para la aplicación:

```sql
CREATE DATABASE camaras_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'camaras_user'@'localhost' IDENTIFIED BY 'UNA_CONTRASENA_SEGURA';
GRANT ALL PRIVILEGES ON camaras_db.* TO 'camaras_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

**Nota:** Reemplaza `UNA_CONTRASENA_SEGURA` por una contraseña fuerte.

### **4. Despliegue de la Aplicación Laravel**

Inicia sesión como el usuario `deploy`:

```bash
su deploy
cd ~
```

Clona tu repositorio de GitHub (o sube los archivos de tu proyecto):

```bash
git clone TU_URL_DEL_REPOSITORIO.git camaras-app
cd camaras-app
```

Instala las dependencias de PHP:

```bash
composer install --no-dev --optimize-autoloader
```

Instala las dependencias de Node.js:

```bash
npm install && npm run build
```

### **5. Configuración de Laravel**

Crea y edita el archivo de entorno `.env`:

```bash
cp .env.example .env
nano .env
```

Ajusta las siguientes variables en el archivo `.env`:

```ini
APP_NAME="Cámaras Daganet"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://camaras.daganet.net

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=camaras_db
DB_USERNAME=camaras_user
DB_PASSWORD=UNA_CONTRASENA_SEGURA

# Configura tu SMTP para el envío de correos
MAIL_MAILER=smtp
MAIL_HOST=smtp.zoho.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@zoho.com
MAIL_PASSWORD=tu_contrasena_de_app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="tu_correo@zoho.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Genera la clave de la aplicación y ejecuta las migraciones:

```bash
php artisan key:generate
php artisan migrate --force
```

Configura los permisos correctos para que Laravel pueda escribir en las carpetas de `storage` y `bootstrap/cache`:

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### **6. Configuración de Nginx**

Crea un archivo de configuración para tu sitio:

```bash
sudo nano /etc/nginx/sites-available/camaras.daganet.net
```

Pega el siguiente contenido:

```nginx
server {
    listen 80;
    server_name camaras.daganet.net;
    root /home/deploy/camaras-app/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Activa el sitio y reinicia Nginx:

```bash
sudo ln -s /etc/nginx/sites-available/camaras.daganet.net /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### **7. Instalación de Certificado SSL (HTTPS)**

Instala Certbot para obtener un certificado SSL gratuito de Let's Encrypt:

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d camaras.daganet.net
```

Sigue las instrucciones en pantalla para configurar la redirección automática a HTTPS.

### **8. Optimización para Producción**

Para mejorar el rendimiento, ejecuta los siguientes comandos:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

¡Felicidades\! Tu aplicación ya debería estar funcionando en `https://camaras.daganet.net`.

## **Uso de la Aplicación**

  * **Acceso de Administrador:**

      * URL: `https://camaras.daganet.net/admin/login`
      * Credenciales: Las que hayas configurado en tu seeder de la base de datos (por ejemplo, `admin@admin.com` / `admin123`).

  * **Acceso de Cliente:**

      * URL: `https://camaras.daganet.net`
      * Usuario: Cédula del cliente.
      * Contraseña: Los últimos 5 dígitos de la cédula (se pedirá cambiarla en el primer acceso).

## **Mantenimiento**

  * **Limpiar Caché:** Si realizas cambios en el código o en los archivos `.env`, es recomendable limpiar la caché:
    ```bash
    php artisan optimize:clear
    ```
  * **Ejecutar Migraciones:** Para aplicar nuevos cambios en la base de datos:
    ```bash
    php artisan migrate --force
    ```
