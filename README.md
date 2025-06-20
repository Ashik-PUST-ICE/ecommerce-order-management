# E-Commerce Order Management System

A Laravel-based order management system with role-based access control for Super Admin, Admin, and Outlet In charge.

## Features

- **Role-Based Access Control**:
  - Super Admin: Full system access
  - Admin: View all orders, accept/cancel orders, transfer between outlets
  - Outlet In charge: View only their outlet's orders, accept orders, transfer if needed

- **Frontend Features**:
  - Product catalog with filtering by outlet
  - Shopping cart functionality
  - Checkout process

- **Backend Features**:
  - Order management dashboard
  - Order status tracking (pending, processing, completed, cancelled)
  - Soft delete for all models
  - REST API endpoints

## Technologies Used

- PHP 8.0+
- Laravel 9.x
- MySQL 5.7+
- Bootstrap 5
- jQuery (for AJAX interactions)

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/ecommerce-order-management.git
   cd ecommerce-order-management
Install dependencies:


composer install
npm install
Create environment file:


cp .env.example .env
Generate application key:


php artisan key:generate
Configure database:
Edit .env file with your database credentials:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_order
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password


Run migrations and seeders:
php artisan migrate --seed
Build frontend assets:


npm run dev
Set up storage link:

php artisan storage:link
Run the application:


php artisan serve
Default Users
The system comes with pre-seeded users for each role:

Super Admin:

Email: superadmin@example.com

Password: password

Admin:

Email: admin@example.com

Password: password

Outlet In charge:

Email: outlet@example.com

Password: password
