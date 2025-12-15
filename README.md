# Backend API Restaurant

REST API untuk sistem Point of Sale (POS) Restaurant dengan autentikasi dan role-based authorization.

## Tech Stack

-   Laravel 12
-   PHP 8.2
-   Laravel Sanctum (Token-based Authentication)
-   MySQL

## Features

-   Token-based authentication dengan Laravel Sanctum
-   Role-based authorization (Admin & Kasir)
-   Order management dengan automatic stock deduction
-   Product, Category, Payment management
-   User management (Admin only)
-   Receipt code generation
-   Transaction handling dengan database transaction

## Database Schema

-   users (admin, kasir)
-   categories
-   products
-   payments
-   orders
-   orders_products (pivot table)

## Installation

1. Clone repository

```bash
git clone <repository-url>
cd backend-api-restaurant
```

2. Install dependencies

```bash
composer install
npm install
```

3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database di file `.env`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restaurant_db
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations

```bash
php artisan migrate
```

6. Create admin user via tinker

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'Administrator',
    'email' => 'admin@resto.com',
    'password' => \Hash::make('admin123'),
    'role' => 'admin'
]);
```

7. Run development server

```bash
composer run dev
```

Server akan berjalan di `http://localhost:8000`

## API Endpoints

### Authentication

| Method | Endpoint      | Description              | Access        |
| ------ | ------------- | ------------------------ | ------------- |
| POST   | `/api/login`  | Login dan dapatkan token | Public        |
| POST   | `/api/logout` | Logout dan revoke token  | Authenticated |
| GET    | `/api/user`   | Get current user info    | Authenticated |

### Users Management

| Method | Endpoint          | Description     | Access |
| ------ | ----------------- | --------------- | ------ |
| GET    | `/api/users`      | List all users  | Admin  |
| POST   | `/api/users`      | Create new user | Admin  |
| GET    | `/api/users/{id}` | Get user detail | Admin  |
| PUT    | `/api/users/{id}` | Update user     | Admin  |
| DELETE | `/api/users/{id}` | Delete user     | Admin  |

### Categories

| Method | Endpoint               | Description         | Access       |
| ------ | ---------------------- | ------------------- | ------------ |
| GET    | `/api/categories`      | List categories     | Admin, Kasir |
| POST   | `/api/categories`      | Create category     | Admin        |
| GET    | `/api/categories/{id}` | Get category detail | Admin, Kasir |
| PUT    | `/api/categories/{id}` | Update category     | Admin        |
| DELETE | `/api/categories/{id}` | Delete category     | Admin        |

### Products

| Method | Endpoint             | Description        | Access       |
| ------ | -------------------- | ------------------ | ------------ |
| GET    | `/api/products`      | List products      | Admin, Kasir |
| POST   | `/api/products`      | Create product     | Admin        |
| GET    | `/api/products/{id}` | Get product detail | Admin, Kasir |
| PUT    | `/api/products/{id}` | Update product     | Admin        |
| DELETE | `/api/products/{id}` | Delete product     | Admin        |

### Payments

| Method | Endpoint             | Description           | Access       |
| ------ | -------------------- | --------------------- | ------------ |
| GET    | `/api/payments`      | List payment methods  | Admin, Kasir |
| POST   | `/api/payments`      | Create payment method | Admin        |
| GET    | `/api/payments/{id}` | Get payment detail    | Admin, Kasir |
| PUT    | `/api/payments/{id}` | Update payment method | Admin        |
| DELETE | `/api/payments/{id}` | Delete payment method | Admin        |

### Orders

| Method | Endpoint           | Description      | Access                        |
| ------ | ------------------ | ---------------- | ----------------------------- |
| GET    | `/api/orders`      | List orders      | Admin (all), Kasir (own only) |
| POST   | `/api/orders`      | Create order     | Admin, Kasir                  |
| GET    | `/api/orders/{id}` | Get order detail | Admin (all), Kasir (own only) |
| PUT    | `/api/orders/{id}` | Update order     | Admin (all), Kasir (own only) |
| DELETE | `/api/orders/{id}` | Delete order     | Admin                         |

## Authentication

Semua endpoint (kecuali `/api/login`) membutuhkan token di header:

```
Authorization: Bearer {token}
```

### Login Request

```json
POST /api/login
Content-Type: application/json

{
  "email": "admin@resto.com",
  "password": "admin123"
}
```

### Login Response

```json
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "user": {
            "id": 1,
            "name": "Administrator",
            "email": "admin@resto.com",
            "role": "admin"
        },
        "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
    }
}
```

## Create Order Example

```json
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
  "payment_type_id": 1,
  "name": "John Doe",
  "total_paid": 100000,
  "items": [
    {
      "product_id": 1,
      "qty": 2,
      "price": 25000
    },
    {
      "product_id": 2,
      "qty": 1,
      "price": 50000
    }
  ]
}
```

## Access Control

### Admin

-   Full CRUD pada semua resource
-   Dapat melihat dan manage semua orders
-   Dapat delete orders
-   Dapat create/update/delete users

### Kasir

-   Read-only pada categories, products, payments
-   Dapat create orders
-   Hanya dapat melihat dan edit orders yang dibuat sendiri
-   Tidak dapat delete orders
-   Tidak dapat akses user management

## Development

Run development server dengan hot reload:

```bash
composer run dev
```

Run tests:

```bash
php artisan test
```

## License

MIT License
