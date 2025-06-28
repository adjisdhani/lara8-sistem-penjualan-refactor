# Refactor aplikasi sistem informasi penjualan simple (Laravel 8)

Aplikasi CRUD penjualan dengan fitur:
- Modular MVC + Repository Pattern
- Role & Permission (Admin, Staff)
- Laravel Fortify (Auth)
- Menu dinamis berdasarkan role
- Export ke Excel
- Validasi custom dengan FormRequest

## Prerequisites

Ensure you have the following installed on your system:

- **Node.js** (v14 or higher)
- **MySQL**
- **npm** (Node Package Manager)
-- **PHP version 7.4**

## Login Demo
- Email: admin@example.com
- Password: password

## Installation Steps

Follow these steps to set up the project:

### 1. Clone the Repository
```bash
git clone https://github.com/adjisdhani/lara8-sistem-penjualan-refactor
```

### 2. Navigate to the Project Directory
```bash
cd lara8-sistem-penjualan-refactor
```

### 3. Install Dependencies
Install the required dependencies by running:
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve
```

sukses selalu ya mas 

---

## Author

Adjis Ramadhani Utomo

---

## License
This project is open-source.