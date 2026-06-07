# Sistem Manajemen Pegawai

Sistem Manajemen Pegawai adalah aplikasi berbasis web yang dibangun menggunakan Laravel 11 untuk membantu pengelolaan data pegawai secara terpusat. Aplikasi ini memungkinkan admin untuk melakukan pencatatan, pencarian, pengelolaan, dan monitoring data pegawai melalui dashboard yang modern dan responsif.

## Fitur Utama

### Autentikasi

* Login Admin
* Logout Admin
* Proteksi halaman menggunakan Middleware Authentication

### Dashboard

* Total Pegawai
* Total Pegawai Aktif
* Total Pegawai Nonaktif
* Daftar Pegawai

### Manajemen Pegawai

* Tambah Pegawai
* Lihat Daftar Pegawai
* Edit Data Pegawai
* Hapus Data Pegawai
* Pencarian berdasarkan Nama atau NIK

## Struktur Data Pegawai

| Field             | Tipe             |
| ----------------- | ---------------- |
| Nama              | String           |
| NIK               | String (Unique)  |
| Departemen        | String           |
| Jabatan           | String           |
| Status            | Aktif / Nonaktif |
| Tanggal Bergabung | Date             |

## Teknologi yang Digunakan

### Backend

* Laravel 11
* PHP 8.3

### Frontend

* Blade Template Engine
* Tailwind CSS
* Remix Icon

### Database

* MySQL

### Authentication

* Laravel Breeze

### Version Control

* Git
* GitHub

## Instalasi

### Clone Repository

```bash
git clone https://github.com/ChikaYunitaBahri/Manajemen-Pegawai
```

Masuk ke folder project:

```bash
cd manajemenpegawai
```

### Install Dependency

```bash
composer install
```

```bash
npm install
```

### Konfigurasi Environment

Copy file environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Atur konfigurasi database pada file `.env`.

### Migrasi dan Seeder

```bash
php artisan migrate:fresh --seed
```

### Menjalankan Aplikasi

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

## Akun Demo

Setelah menjalankan seeder, gunakan akun berikut:

Email:

```text
admin@gmail.com
```

Password:

```text
password
```

## Seeder

Seeder yang tersedia:

### UserSeeder

Membuat akun administrator.

### EmployeeFactory

Menghasilkan data pegawai dummy secara otomatis menggunakan Faker.

## Struktur Folder

```text
app
├── Http
│   └── Controllers
│       ├── DashboardController.php
│       └── EmployeeController.php
│
├── Models
│   ├── Employee.php
│   └── User.php
│
resources
└── views
    ├── dashboard.blade.php
    ├── layouts
    │   └── app.blade.php
    └── employees
        ├── index.blade.php
        ├── create.blade.php
        └── edit.blade.php
```

## Screenshot

Tambahkan screenshot aplikasi pada bagian ini setelah deployment.

### Dashboard

`assets/dashboard.png`

### Data Pegawai

`assets/employees.png`

### Tambah Pegawai

`assets/create-employee.png`

## Pengembang

Dikembangkan sebagai proyek pembelajaran dan implementasi Sistem Informasi menggunakan Laravel Framework.

---

© 2026 Sistem Manajemen Pegawai
