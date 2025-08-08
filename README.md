
# 🛒 Laravel 12 E-Commerce Platform

This project is a modular and scalable Laravel-based e-commerce system with:

- ✅ Dynamic **Category & Subcategory** Hierarchy  
- ✅ Category-specific **Attributes**  
- ✅ Full-featured **Admin Panel** using Laravel Breeze  
- ✅ **RESTful APIs** to be consumed by a Nuxt frontend  
- ✅ Category-wise product filters  
- ✅ Tailwind CSS integration  

---

## 📁 Project Structure

```
laravel-ecommerce/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
│   └── views/         → Admin panel views (Blade)
├── routes/
│   ├── web.php        → Admin panel routes
│   └── api.php        → Public APIs
├── nuxt/              → Nuxt frontend (if monorepo)
└── README.md
```

---

## 🧑‍💼 Admin Panel (Laravel Breeze)

### ✅ Features

- Admin-authenticated login
- CRUD for:
  - Categories (with parent-child nesting)
  - Attributes (assigned to categories, required/optional)
  - Products (dynamic form based on category attributes)
- Blade + TailwindCSS UI
- Server-side rendered forms (non-AJAX)

### 🔐 Login

```
URL: http://localhost:8000/login
```

> Admin users should be seeded or created manually via tinker.

---

## 🔌 API Endpoints (Laravel Sanctum)

These APIs are meant to be consumed by the Nuxt frontend or mobile apps.

### 🔓 Authentication

Ensure you have a bearer token or pass session cookie using `credentials: 'include'`.

---

### 📦 Products

| Method | Endpoint                         | Description                       |
|--------|----------------------------------|-----------------------------------|
| GET    | `/api/v1/products`               | List all products (paginated)     |
| GET    | `/api/v1/products?category_id=2` | Filter products by category       |
| POST   | `/api/v1/products`               | Create a new product (admin only) |

---

### 🗂 Categories

| Method | Endpoint                     | Description                        |
|--------|------------------------------|------------------------------------|
| GET    | `/api/v1/categories`         | Get all parent categories + nested children |
| GET    | `/api/v1/categories/{id}/attributes` | Get category-specific attributes |

---

## 🔧 Environment Setup

### 🛠 Laravel

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

> Breeze uses Vite. Run this in another terminal:

```bash
npm install
npm run dev
```

---

## 🌐 Nuxt Frontend (if using monorepo)

Assuming Nuxt 3 is in `/nuxt`:

```bash
cd nuxt
npm install
npm run dev
```

Make sure CORS is enabled in Laravel, and API URLs point to `http://localhost:8000`.

---

## 🗃 Database Schema

- `categories` → supports nested subcategories
- `attributes` → attribute definitions
- `attribute_category` → pivot for attributes per category (with `is_required`)
- `products` → product master table
- `attribute_values` → stores attribute values per product

---

## ✅ To-Do / Future

- Product images
- Stock/inventory system
- Cart & Checkout
- Role-based admin permissions
- Product search API
