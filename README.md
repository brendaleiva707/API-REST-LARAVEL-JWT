# 📝 API de Gestión de Posts
CRUD para la gestión de posts de usuarios.

---

## 📦 Requisitos

- PHP >= 8.2  
- Composer  
- Laravel 12  
- MySQL 
- Postman (para probar la API)  

---

## 🚀 Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/brendaleiva707/API-REST-LARAVEL-JWT.git
cd API-REST-LARAVEL-JWT

2. Instalar dependencias 
```bash
composer install

3. Copiar archivo de entorno
```bash
cp .env.example .env

4. Configurar el archivo .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña

5. Generar la clave de la app en la terminal:
php artisan key:generate

6. Ejecutar migraciones:
php artisan migrate

7. Levantar el servidor:
php artisan serve

8. Endpoints públicos:
POST /api/register → Registro de usuario

POST /api/login → Login y generación de token

9. Autenticación en Postman:
Una vez logueado, copiar el token de la respuesta

En las rutas protegidas, agregar el token como Bearer Token en los headers




