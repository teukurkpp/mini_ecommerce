# Mini E-Commerce API

Mini E-Commerce API adalah backend RESTful API sederhana yang dibangun menggunakan Laravel 12. Proyek ini menyediakan fitur autentikasi pengguna menggunakan Laravel Sanctum, manajemen produk, manajemen kategori, serta dokumentasi API otomatis menggunakan Scribe.

## Features

* User Registration
* User Login & Logout (Laravel Sanctum)
* Product Management (CRUD)
* Category Management
* Product Search
* Pagination
* API Documentation with Scribe
* Token-Based Authentication

## Technology Stack

* Laravel 12
* PHP 8+
* MySQL
* Laravel Sanctum
* Scribe
* Postman

## Installation

Clone repository:

```bash
git clone <repository-url>
cd mini_ecommerce
```

Install dependencies:

```bash
composer install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seeders:

```bash
php artisan migrate --seed
```

Create storage link:

```bash
php artisan storage:link
```

Generate API documentation:

```bash
php artisan scribe:generate
```

Run application:

```bash
php artisan serve
```

## Default User

```text
Email    : admin@gmail.com
Password : password
```

## API Documentation

After running the application, API documentation can be accessed at:

```text
http://127.0.0.1:8000/docs
```

## Available Endpoints

### Authentication

* POST /api/register
* POST /api/login
* POST /api/logout

### Products

* GET /api/products
* POST /api/products
* GET /api/products/{id}
* PUT /api/products/{id}
* DELETE /api/products/{id}

### Categories

* GET /api/categories

## Authentication

Most endpoints require Bearer Token authentication.

Example:

```http
Authorization: Bearer YOUR_ACCESS_TOKEN
```

## Project Structure

```text
app/
├── Http/Controllers/Api
├── Models
database/
├── factories
├── migrations
├── seeders
routes/
└── api.php
```

## License

This project is developed for educational and learning purposes.
