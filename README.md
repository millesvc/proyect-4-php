# Enterprise Product Admin - CRUD MVC en PHP

Sistema web administrativo CRUD desarrollado en **PHP 8+** y **MySQL**, con arquitectura **MVC**, autenticación por sesión y una interfaz moderna tipo panel interno empresarial.

## Características

- Arquitectura profesional MVC sin frameworks externos
- Autenticación por sesión
- CRUD completo de productos
- Búsqueda por nombre
- Validaciones del lado del servidor
- Conexión segura con PDO
- Prepared Statements contra SQL Injection
- Escape de salida contra XSS
- Mensajes flash y confirmación para eliminar
- Estilo oscuro, moderno y responsive
- Preparado para portafolio técnico y entrevistas

## Estructura

```bash
/config/database.php
/models/Product.php
/models/User.php
/controllers/ProductController.php
/controllers/AuthController.php
/middleware/AuthMiddleware.php
/views/products/index.php
/views/products/create.php
/views/products/edit.php
/views/products/show.php
/views/auth/login.php
/core/Router.php
/core/Controller.php
/core/Model.php
/public/index.php
/public/assets/css/app.css
/schema.sql
/README.md
```

## Requisitos

- PHP 8.0 o superior
- MySQL / MariaDB
- Apache o servidor local compatible
- Extensión PDO MySQL habilitada

## Instalación

### 1. Copiar el proyecto
Coloca la carpeta en tu entorno local, por ejemplo:

- XAMPP: `htdocs/product-crud-mvc`
- MAMP: `htdocs/product-crud-mvc`

### 2. Crear la base de datos
Importa el archivo `schema.sql` desde phpMyAdmin o terminal.

Ejemplo por terminal:

```bash
mysql -u root -p < schema.sql
```

### 3. Revisar credenciales de conexión
Edita `config/database.php` y ajusta:

- host
- nombre de base de datos
- usuario
- contraseña

### 4. Abrir el proyecto
Apunta el navegador a:

```bash
http://localhost/product-crud-mvc/public/
```

## Acceso demo

```txt
Email: admin@empresa.com
Password: Admin123*
```

## Funcionalidades incluidas

### Autenticación
- Login por correo y contraseña
- Sesión regenerada tras login
- Middleware para restringir acceso
- Logout seguro

### Productos
- Listar productos en tabla ordenada
- Crear producto con validación
- Editar producto existente
- Eliminar con confirmación
- Buscar por nombre
- Ver detalle completo

## Seguridad aplicada

- PDO con `ERRMODE_EXCEPTION`
- `ATTR_EMULATE_PREPARES = false`
- Consultas preparadas en todas las operaciones sensibles
- Escape HTML con `htmlspecialchars`
- Protección CSRF en formularios POST
- Restricción de acceso por sesión
