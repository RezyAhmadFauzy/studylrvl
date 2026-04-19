# 🎓 Sistem Autentikasi & Dashboard - Dokumentasi Lengkap

## 📋 Daftar Isi

1. [Ringkasan Sistem](#ringkasan-sistem)
2. [Struktur File](#struktur-file)
3. [File yang Dibuat](#file-yang-dibuat)
4. [Setup & Instalasi](#setup--instalasi)
5. [Cara Menggunakan](#cara-menggunakan)
6. [Demo Login](#demo-login)
7. [Fitur-Fitur](#fitur-fitur)
8. [Customisasi](#customisasi)
9. [Troubleshooting](#troubleshooting)

---

## 📌 Ringkasan Sistem

Sistem ini adalah **Sistem Autentikasi Modern** dengan fitur:

- ✅ Login & Register dengan validasi
- ✅ Dashboard Admin dengan statistik & chart
- ✅ Dashboard Siswa dengan riwayat pengaduan
- ✅ Dark mode toggle
- ✅ Responsive design mobile-first
- ✅ Role-based access control (Admin/Siswa)
- ✅ Modern UI dengan glassmorphism design
- ✅ Password strength meter
- ✅ Real-time form validation

---

## 📁 Struktur File

```
studylrvl/
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php          ✨ Halaman Login
│       │   └── register.blade.php       ✨ Halaman Register
│       └── dashboard/
│           ├── admin.blade.php          ✨ Dashboard Admin
│           └── siswa.blade.php          ✨ Dashboard Siswa
│
├── public/
│   ├── css/
│   │   └── style.css                    ✨ CSS Comprehensive (Baru)
│   └── js/
│       └── script.js                    ✨ JavaScript Comprehensive (Baru)
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── AuthController.php       ✨ Auth Logic
│   └── Models/
│       └── User.php                     ✨ User Model
│
├── routes/
│   └── web.php                          ✨ Routes Configuration
│
└── database/
    └── migrations/
        └── 0001_01_01_000000_create_users_table.php  ✨ Users Table
```

---

## ✨ File yang Dibuat

### 1. **resources/views/auth/login.blade.php**

- Halaman login dengan glassmorphism design
- Form validation
- Show/hide password toggle
- Demo credentials display
- Responsive design

### 2. **resources/views/auth/register.blade.php**

- Halaman register siswa
- Multi-field form (nama, NIS, kelas, username, email, password)
- Password strength meter
- Real-time validation
- Terms & conditions checkbox

### 3. **resources/views/dashboard/admin.blade.php**

- Admin dashboard lengkap
- Sidebar navigation dengan badge count
- Top navbar dengan dark mode toggle
- 4 Statistics cards (Total Pengaduan, Sedang Diproses, Selesai, Total Siswa)
- 3 Chart.js visualizations:
    - Bar chart: Monthly complaints
    - Doughnut chart: Status distribution
    - Line chart: 7-day activity
- Recent complaints table
- AOS scroll animations

### 4. **resources/views/dashboard/siswa.blade.php**

- Student dashboard
- Simplified sidebar navigation
- 4 Statistics cards (personal complaint stats)
- Doughnut chart: Personal complaint status
- Quick complaint form
- Recent complaints table with progress bars
- Info tips alert

### 5. **public/css/style.css** (NEW)

- Comprehensive CSS consolidation (2000+ lines)
- Dashboard layout & styling
- Sidebar styling
- Navbar styling
- Statistics cards
- Charts styling
- Tables styling
- Form elements
- Dark mode support
- Responsive breakpoints (480px, 600px, 768px, 1200px)
- Animations & transitions
- Scrollbar customization

### 6. **public/js/script.js** (NEW)

- Comprehensive JavaScript consolidation (800+ lines)
- Dark mode toggle with localStorage
- Sidebar toggle functionality
- Dropdown menus
- Chart.js initialization (Bar, Pie, Doughnut, Line)
- Form validation
- Password strength meter
- Password toggle show/hide
- AOS (Animate on Scroll) initialization
- Utility functions:
    - formatCurrency()
    - formatDate()
    - formatTime()
    - showNotification()
    - toggleLoader()

---

## 🚀 Setup & Instalasi

### Prerequisites

- Laragon (atau XAMPP) dengan PHP 8.1+
- Composer
- Node.js (optional, untuk Vite)
- MySQL/MariaDB

### Langkah-Langkah

#### 1. Clone/Setup Project

```bash
cd c:\laragon\www\studylrvl
```

#### 2. Install Dependencies

```bash
composer install
npm install
```

#### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Database Setup

```bash
# Update .env dengan database credentials
# DB_DATABASE=studylrvl
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Optional: Seed demo data
php artisan db:seed
```

#### 5. Start Development Server

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Build Vite assets
npm run dev
```

#### 6. Access Application

```
URL: http://localhost:8000/login
atau
URL: http://localhost/studylrvl/public/login (dengan Laragon)
```

---

## 📖 Cara Menggunakan

### Login

1. Buka halaman login di `http://localhost:8000/login`
2. Masukkan **username** dan **password**
3. Sistem akan otomatis redirect ke dashboard sesuai role:
    - **Admin** → `/dashboard`
    - **Siswa** → `/student/dashboard`

### Register

1. Buka halaman register di `http://localhost:8000/register`
2. Isi semua field:
    - Nama Lengkap
    - NIS (Nomor Induk Siswa)
    - Kelas (10, 11, atau 12)
    - Username (unik, 4+ karakter)
    - Email (unik)
    - Password (8+ karakter, dengan strength meter)
    - Konfirmasi Password
3. Centang "Saya setuju dengan syarat & ketentuan"
4. Klik "Daftar Sekarang"
5. Otomatis login dan redirect ke student dashboard

### Dashboard Usage

#### Admin Dashboard (`/dashboard`)

- **Statistics Cards**: Lihat total pengaduan dan statusnya
- **Charts**: Visualisasi data dengan 3 tipe chart
- **Recent Complaints Table**: Daftar pengaduan terbaru
- **Dark Mode**: Toggle dark mode dengan icon moon/sun di navbar
- **Sidebar Navigation**: Akses berbagai menu admin

#### Student Dashboard (`/student/dashboard`)

- **Statistics Cards**: Lihat statistik pengaduan pribadi
- **Status Chart**: Visualisasi status pengaduan
- **Quick Form**: Buat pengaduan baru langsung dari dashboard
- **Recent Complaints**: Lihat riwayat pengaduan dengan progress bar
- **Dark Mode**: Toggle dark mode

---

## 🎯 Demo Login

### Demo Credentials

Pada halaman login tersedia demo credentials:

#### Admin

```
Username: admin
Password: password123
Role: Admin
```

#### Siswa

```
Username: user
Password: user123
Role: Siswa
```

**Note**: Untuk menggunakan demo credentials, pastikan Anda sudah run migrations atau seed data.

---

## 🎨 Fitur-Fitur

### 1. Modern UI Design

- **Glassmorphism**: Frosted glass effect dengan blur
- **Gradient**: Beautiful gradient backgrounds
- **Animations**: Smooth transitions & scroll animations
- **Color Scheme**: Professional blue gradient (#0a47a8 - #1565d8)

### 2. Dark Mode

- Toggle dark/light mode dengan smooth transition
- Preference disimpan di localStorage
- Semua elemen support dark mode
- Custom dark color scheme (#1a1a2e, #1e1e2e)

### 3. Responsive Design

Breakpoints:

- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px
- **Mobile**: 480px - 767px
- **Small Mobile**: < 480px

### 4. Form Validation

- Client-side validation dengan JavaScript
- Server-side validation di Laravel
- Error messages dengan styling
- Real-time field validation

### 5. Password Strength Meter

```
Strength Levels:
- Sangat Lemah (0): Merah (#dc3545)
- Lemah (1): Orange (#fd7e14)
- Sedang (2): Kuning (#ffc107)
- Kuat (3): Hijau (#20c997)
- Sangat Kuat (4-5): Hijau cerah (#28a745)
```

Criteria:

- 8+ karakter: +1
- 12+ karakter: +1
- Mix case (a-z & A-Z): +1
- Angka: +1
- Special char (!@#$%^&\*): +1

### 6. Charts & Visualization

Menggunakan Chart.js v3.9.1:

- **Bar Chart**: Monthly trends
- **Doughnut Chart**: Status distribution
- **Line Chart**: 7-day activity

### 7. Animations

- **Page Load**: slideUp animation
- **Cards**: fadeUp with stagger (AOS)
- **Logo**: bounceIn animation
- **Hover**: Lift effect on cards
- **Transitions**: Smooth 0.3s transitions

---

## 🎨 Customisasi

### Mengubah Color Scheme

Edit `public/css/style.css`:

```css
:root {
    --primary-color: #0a47a8; /* Ubah warna primary */
    --secondary-color: #1565d8; /* Ubah warna secondary */
    /* ... warna lainnya ... */
}
```

### Mengubah Font

Tambahkan import di `public/css/style.css`:

```css
@import url("https://fonts.googleapis.com/css2?family=YourFont:wght@300;400;600;700;800&display=swap");

* {
    font-family: "YourFont", sans-serif;
}
```

### Mengubah Logo/Icon

Edit di blade files:

```blade
<div class="brand-logo">🎓</div>  <!-- Ubah emoji ini -->
```

### Menambah Custom CSS Class

1. Buka `public/css/style.css`
2. Tambahkan class baru di bagian yang sesuai
3. Refresh halaman

### Menambah Custom JavaScript

1. Buka `public/js/script.js`
2. Tambahkan function baru di bagian yang sesuai
3. Expose via `window.DashboardUtils` jika global

---

## 🔧 Troubleshooting

### Issue: Login tidak berfungsi

**Solusi**:

1. Pastikan .env sudah configured dengan database yang benar
2. Run `php artisan migrate` untuk membuat tables
3. Check error log di `storage/logs/laravel.log`
4. Pastikan password di database di-hash dengan `Hash::make()`

### Issue: Dark mode tidak tersimpan

**Solusi**:

1. Check if browser allows localStorage
2. Clear browser cache & cookies
3. Try incognito/private mode untuk test

### Issue: CSS tidak loading

**Solusi**:

1. Check if file `public/css/style.css` exists
2. Run `php artisan serve` (bukan `php -S`)
3. Check console for 404 errors
4. Clear browser cache (Ctrl+Shift+Delete)

### Issue: Chart tidak tampil

**Solusi**:

1. Pastikan Chart.js CDN accessible
2. Check browser console untuk JavaScript errors
3. Pastikan canvas element dengan correct ID ada di HTML

### Issue: Form validation tidak berfungsi

**Solusi**:

1. Check form has `data-validate="true"` attribute
2. Check input fields have `required` attribute
3. Check browser console untuk JavaScript errors
4. Pastikan `public/js/script.js` sudah loaded

### Issue: Database connection error

**Solusi**:

1. Check `.env` file has correct DB credentials
2. Verify MySQL/MariaDB service is running
3. Check database exists: `studylrvl` atau ganti di `.env`
4. Run `php artisan db:seed` jika belum punya data

---

## 📚 Teknologi yang Digunakan

### Backend

- **Laravel 11**: PHP web framework
- **Eloquent ORM**: Database abstraction
- **Blade Templating**: HTML templating engine

### Frontend

- **Bootstrap 5.3**: CSS framework
- **Chart.js 3.9**: Data visualization
- **Font Awesome 6.4**: Icon library
- **AOS (Animate on Scroll)**: Scroll animations
- **Vanilla JavaScript**: ES6+ features

### Database

- **MySQL/MariaDB**: Relational database
- **Migrations**: Schema version control

---

## 🔐 Security Best Practices

### Implemented

✅ Password hashing dengan Hash::make()
✅ CSRF protection via @csrf token
✅ Input validation (server-side)
✅ SQL injection prevention (Eloquent)
✅ Session security
✅ User authentication with 'auth' middleware
✅ Guest-only pages with 'guest' middleware

### Additional Security Tips

- Jangan expose sensitive data di source code
- Always validate input di server-side
- Use HTTPS in production
- Regularly update dependencies
- Use environment variables untuk secrets
- Implement rate limiting untuk login attempts

---

## 📝 File Structure Reference

```
public/
├── css/
│   └── style.css              ← Main comprehensive CSS
├── js/
│   └── script.js              ← Main comprehensive JavaScript
└── uploads/
    └── pengaduan/             ← Complaint uploads folder

resources/
├── views/
│   ├── auth/
│   │   ├── login.blade.php    ← Login page
│   │   └── register.blade.php ← Register page
│   └── dashboard/
│       ├── admin.blade.php    ← Admin dashboard
│       └── siswa.blade.php    ← Student dashboard
└── css/
    └── app.css                ← Global app styles

app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php ← Authentication logic
│   │   └── PengaduanController.php
│   └── Middleware/
└── Models/
    └── User.php               ← User model

routes/
└── web.php                    ← All routes defined

database/
├── migrations/
│   └── 0001_01_01_000000_create_users_table.php
└── seeders/
    └── DatabaseSeeder.php
```

---

## 🎓 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [Chart.js Documentation](https://www.chartjs.org/docs/latest/)
- [MDN Web Docs](https://developer.mozilla.org/)

---

## 📞 Support

Untuk bantuan atau pertanyaan:

1. Check error logs: `storage/logs/laravel.log`
2. Check browser console (F12 → Console tab)
3. Review documentation di folder project
4. Check routing dengan: `php artisan route:list`

---

**Version**: 1.0.0  
**Last Updated**: April 2026  
**Framework**: Laravel 11  
**License**: MIT
