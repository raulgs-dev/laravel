## 📋 Descripción

La aplicación permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) sobre los siguientes módulos:

* **Clientes:** Gestión de la cartera de clientes.
* **Productos:** Catálogo de productos disponibles.
* **Proveedores:** Registro de proveedores de la empresa.
* **Empleados:** Administración del personal.
* **Categorías:** Clasificación de los productos.

El proyecto cuenta con una interfaz visual limpia utilizando **Bootstrap 5**.

## Requisitos Previos

Para ejecutar este proyecto en tu máquina local, necesitas tener instalado:

* **PHP:** Versión 8.2 o superior.
* **Composer:** Gestor de dependencias de PHP.
* **MySQL / MariaDB:** Servidor de base de datos (puedes usar XAMPP, Laragon, etc.).
* **Navegador Web:** Chrome, Firefox, Edge, etc.

## 🚀 Pasos de Instalación

Sigue estos pasos para descargar y configurar el proyecto:

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/raulgs-dev/laravel.git](https://github.com/raulgs-dev/laravel.git)
    cd laravel
    ```

2.  **Instalar dependencias de PHP:**
    Como la carpeta `vendor` no se sube a GitHub, debes regenerarla:
    ```bash
    composer install
    ```

3.  **Configurar el entorno:**
    Duplica el archivo de ejemplo y renómbralo:
    ```bash
    cp .env.example .env
    ```
    Abre el archivo `.env` y configura tu base de datos:
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=crm_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generar la clave de aplicación:**
    ```bash
    php artisan key:generate
    ```

5.  **Base de Datos:**
    Tienes dos opciones para configurar la base de datos:
    * **Opción A (Recomendada):** Importa el archivo `crm_db.sql` incluido en la raíz del proyecto usando PHPMyAdmin o tu gestor de base de datos favorito.
    * **Opción B (Migraciones):** Ejecuta el comando `php artisan migrate` (esto creará las tablas vacías).

6.  **Ejecutar el servidor:**
    ```bash
    php artisan serve
    ```
    Entra en tu navegador a: `http://localhost:8000`

## Usuario y Contraseña

Actualmente, el sistema está configurado con acceso abierto para facilitar las pruebas de desarrollo.

* **Acceso:** Directo (Redirige automáticamente al módulo de Clientes).
* **Ruta principal:** `/clientes`
* **Autenticación:** No requerida en esta versión.

---
