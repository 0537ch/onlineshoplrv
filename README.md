# Laravel E-commerce Platform

A modern e-commerce platform built with Laravel 11, featuring a responsive frontend and powerful admin dashboard.

## Features

- 🛍️ **Product Management**
  - Product categories and brands
  - Product variants and SKUs
  - Inventory tracking
  - Discount management

- 🛒 **Shopping Experience**
  - User-friendly cart system
  - Wishlist functionality
  - Coupon system
  - Streamlined checkout process

- 👤 **User Management**
  - Secure authentication with Laravel Fortify
  - Role-based access control
  - Customer profiles
  - Address management

- 📊 **Admin Dashboard**
  - Built with Filament
  - Sales analytics
  - Order management
  - User management
  - Product catalog management

## Tech Stack

- **Backend:** Laravel 11
- **Admin Panel:** Filament 3
- **Frontend:** 
  - Blade Templates
  - Alpine.js
  - Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Fortify
- **API Authentication:** Laravel Sanctum

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## Installation

1. Clone the repository
```bash
git clone https://github.com/0537ch/onlineshoplrv.git
```

2. Install PHP dependencies
```bash
composer install
```

3. Install NPM dependencies
```bash
npm install
```

4. Create environment file
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

6. Configure your database in .env file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run migrations and seeders
```bash
php artisan migrate --seed
```

8. Build assets
```bash
npm run build
```

9. Start the development server
```bash
php artisan serve
```

## Usage

- **Customer Interface:** Access the shop at `http://localhost:8000`
- **Admin Dashboard:** Access admin panel at `http://localhost:8000/admin`
  - Default admin credentials:
    - Email: admin@example.com
    - Password: password

## Security

- CSRF Protection
- XSS Prevention
- SQL Injection Protection
- Role-based Access Control
- Secure Password Hashing


