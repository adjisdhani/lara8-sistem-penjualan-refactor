# Refactor Aplikasi Sistem Informasi Penjualan (Laravel 8)

Aplikasi CRUD penjualan dengan fitur:
- Modular MVC + Repository Pattern
- Role & Permission (Admin, Staff)
- Laravel Fortify (Auth)
- Menu dinamis berdasarkan role
- Export ke Excel
- Validasi custom dengan FormRequest

## 🎯 Tujuan
Project ini dibuat sebagai **latihan dan showcase refactor** dari aplikasi penjualan Laravel sederhana, dengan pendekatan arsitektur modern.

---

## 🚀 Login Demo

- Email: admin@example.com  
- Password: password

---

## 🔧 Prerequisites

Pastikan kamu sudah install:
- **PHP 7.4+**
- **MySQL**
- **Node.js 14+**
- **npm**

---

## 📦 Installation

```bash
git clone https://github.com/adjisdhani/lara8-sistem-penjualan-refactor
cd lara8-sistem-penjualan-refactor
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve


## 🙏 Credit

Aplikasi ini merupakan hasil refactor dari project milik @bagussatoto:
🔗 https://github.com/bagussatoto/Aplikasi-Data-Penjualan-Laravel-8

Project aslinya sangat membantu sebagai bahan belajar.
Refactor ini dilakukan untuk latihan pribadi dan showcase, bukan untuk komersialisasi.

---

## 👨‍💻 Author

Adjis Ramadhani Utomo

---

## License
Project ini tidak memiliki lisensi open-source resmi karena project asal belum menyertakan file LICENSE.
Silakan gunakan untuk belajar dan non-komersial saja.