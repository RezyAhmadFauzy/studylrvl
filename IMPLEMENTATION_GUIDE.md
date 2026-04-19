# 📋 Panduan Implementasi Sistem Autentikasi Modern - Sistem Pengaduan Siswa

## 📌 Daftar Isi

1. [Ringkasan](#ringkasan)
2. [File yang Dibuat/Diupdate](#file-yang-dibuatdiupdate)
3. [Fitur Utama](#fitur-utama)
4. [Instalasi & Setup](#instalasi--setup)
5. [Panduan Penggunaan](#panduan-penggunaan)
6. [Struktur Database](#struktur-database)
7. [API & Route](#api--route)
8. [Customization](#customization)

---

## 🎯 Ringkasan

Sistem autentikasi modern telah dikembangkan untuk website **Sistem Pengaduan Siswa** dengan fitur-fitur professional, desain modern glassmorphism, animasi smooth, dan responsive design.

### Teknologi yang Digunakan:

- **Framework**: Laravel 11
- **Frontend**: Bootstrap 5, HTML5, CSS3
- **Styling**: CSS Modern dengan Animasi Kustom
- **JavaScript**: Vanilla JS + Chart.js + AOS Animation
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Eloquent + Session-based

---

## 📂 File yang Dibuat/Diupdate

### ✨ File HTML/Blade yang Dibuat:

#### 1. **Halaman Login Modern** (`resources/views/auth/login.blade.php`)

- Desain glassmorphism dengan gradient background
- Animasi hover pada input fields
- Toggle password visibility
- Remember me checkbox
- Lupa password link
- Validasi error modern
- Support untuk demo credentials

#### 2. **Halaman Register Siswa** (`resources/views/auth/register.blade.php`)

- Form registrasi khusus siswa dengan fields:
    - Nama Lengkap
    - NIS (Nomor Induk Siswa)
    - Kelas
    - Username
    - Email
    - Password
    - Konfirmasi Password
- Password strength meter dengan feedback real-time
- Animasi input saat fokus
- Terms & conditions checkbox
- Validasi form lengkap

#### 3. **Dashboard Admin Modern** (`resources/views/admin/dashboard.blade.php`)

- Sidebar dengan navigasi lengkap
- Top navbar dengan breadcrumb
- Statistik cards dengan icons
- Grafik (Bar, Pie, Line) menggunakan Chart.js
- Tabel pengaduan terbaru
- Notifications dropdown
- Dark mode toggle
- Profile dropdown

#### 4. **Dashboard Siswa Modern** (`resources/views/student/dashboard-modern.blade.php`)

- Sidebar khusus siswa
- Statistik pengaduan (Total, Pending, Diproses, Selesai)
- Doughnut chart status pengaduan
- Quick form untuk membuat pengaduan
- Riwayat pengaduan dengan progress bar
- Tips section

### 🎨 File CSS yang Dibuat:

#### 1. **Auth Styles** (`public/css/auth.css`)

- Styling untuk login & register pages
- Glassmorphism effect
- Form validation styles
- Password strength meter styles
- Responsive breakpoints
- Dark mode support
- **Size**: ~450 lines

#### 2. **Dashboard Styles** (`public/css/dashboard.css`)

- Comprehensive dashboard styling
- Sidebar styling dengan states
- Navigation styling
- Chart card styling
- Table styling
- Responsive grid system
- Dark mode support
- Animation utilities
- **Size**: ~900 lines

### 📱 File JavaScript yang Dibuat:

#### 1. **Auth JavaScript** (`public/js/auth.js`)

- Password toggle functionality
- Password strength meter logic
- Form validation (real-time & on submit)
- Form submission handling
- Error/success message display
- Double submission prevention
- Session storage untuk form data persistence
- Keyboard shortcuts
- **Features**: ~400 lines

#### 2. **Dashboard JavaScript** (`public/js/dashboard.js`)

- Sidebar toggle & collapse
- Dark mode toggle dengan localStorage
- Notification dropdown
- Profile dropdown
- Chart initialization (Bar, Pie, Line)
- AOS animation initialization
- Utility functions (format currency, date, etc.)
- Toast notifications
- Responsive adjustments
- Performance optimization (lazy loading)
- **Features**: ~500 lines

### 🔧 File Backend yang Diupdate:

#### 1. **AuthController** (`app/Http/Controllers/AuthController.php`)

**Methods Added:**

```php
// Menampilkan halaman register
public function showRegister()

// Handle registrasi siswa baru
public function register(Request $request)
```

**Validation Rules:**

- Nama: required, string, min 3, max 255
- NIS: required, unique, numeric only
- Kelas: required, in (10, 11, 12)
- Username: required, unique, min 4, alphanumeric
- Email: required, email, unique
- Password: required, min 8, confirmed

#### 2. **User Model** (`app/Models/User.php`)

**Fillable Fields Added:**

- `email`
- `nis`
- `kelas`

#### 3. **Routes** (`routes/web.php`)

**Routes Added:**

```php
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
```

#### 4. **Database Migration** (`database/migrations/0001_01_01_000000_create_users_table.php`)

**Columns Added:**

```php
$table->string('email')->unique()->nullable();
$table->string('nis')->unique()->nullable();
$table->string('kelas')->nullable();
$table->string('role')->default('siswa');
```

---

## ✨ Fitur Utama

### 🔐 Sistem Autentikasi

✅ Login dengan username/email dan password
✅ Register khusus siswa
✅ Role-based redirection (Admin → dashboard admin, Siswa → dashboard siswa)
✅ Password hashing dengan bcrypt
✅ Session management
✅ Logout functionality
✅ Remember me feature

### 🎨 Halaman Login

✅ Glassmorphism design dengan blur effect
✅ Gradient background dengan animasi blob
✅ Animasi entrance (slideUp)
✅ Show/hide password toggle
✅ Password validation feedback
✅ Remember me checkbox
✅ Forgot password link
✅ Register link
✅ Error message dengan animasi
✅ Demo credentials display
✅ Loading state pada submit

### 📝 Halaman Register

✅ Multi-field form untuk siswa
✅ Real-time validation
✅ Password strength meter (Lemah, Cukup, Kuat)
✅ Password confirmation validation
✅ Input focus animations
✅ Error handling per field
✅ Terms & conditions checkbox
✅ Success/error messages
✅ Form data persistence dengan sessionStorage

### 📊 Dashboard Admin

✅ Sidebar dengan navigasi lengkap
✅ Collapse sidebar untuk mobile
✅ Top navbar dengan breadcrumb
✅ 4 Statistics cards (Total, Pending, Diproses, Selesai)
✅ Bar chart - Pengaduan per bulan
✅ Pie chart - Status distribution
✅ Line chart - Daily activity (7 hari)
✅ Table pengaduan terbaru
✅ Notifications dropdown
✅ Dark mode toggle
✅ Profile dropdown
✅ AOS scroll animations
✅ Responsive grid layout
✅ Badge status pengaduan

### 🎓 Dashboard Siswa

✅ Simplified sidebar untuk siswa
✅ 4 Statistics cards
✅ Doughnut chart status pengaduan
✅ Quick form untuk membuat pengaduan
✅ Tabel riwayat pengaduan
✅ Progress bar per pengaduan
✅ Tips section
✅ Same modern design sebagai admin dashboard
✅ Dark mode support

### 🌙 Dark Mode

✅ Toggle button di navbar
✅ Automatic stylesheet switching
✅ LocalStorage persistence
✅ Smooth transitions
✅ Applied to semua components

### 📱 Responsive Design

✅ Mobile-first approach
✅ Breakpoints: 480px, 600px, 768px, 1200px
✅ Sidebar hamburger menu di mobile
✅ Touch-friendly buttons
✅ Stacked layout untuk mobile

### ✨ Animasi & Interaksi

✅ Entrance animations (slideUp, bounceIn)
✅ Hover effects pada cards
✅ Input focus animations
✅ Button ripple effect
✅ Smooth transitions (300ms-600ms)
✅ AOS scroll trigger animations
✅ Loading state animations
✅ Dropdown animations

---

## 🚀 Instalasi & Setup

### Prerequisite

- PHP 8.2+
- Laravel 11
- MySQL/MariaDB
- Composer
- npm (optional, untuk Chart.js)

### Step 1: Jalankan Migrasi Database

```bash
php artisan migrate
```

Ini akan membuat tabel `users` dengan kolom baru:

- `email`
- `nis`
- `kelas`
- `role` (default: 'siswa')

### Step 2: Seed Database (Optional)

Jika ingin menambah admin user demo:

```bash
php artisan tinker
```

```php
App\Models\User::create([
    'nama' => 'Admin User',
    'username' => 'admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin',
]);

App\Models\User::create([
    'nama' => 'Siswa Demo',
    'username' => 'siswa',
    'email' => 'siswa@example.com',
    'password' => bcrypt('password'),
    'role' => 'siswa',
    'nis' => '12345',
    'kelas' => '10',
]);
```

### Step 3: Clear Cache

```bash
php artisan config:cache
php artisan view:clear
php artisan cache:clear
```

### Step 4: Akses Aplikasi

```
http://localhost/studylrvl/public
```

---

## 📖 Panduan Penggunaan

### 🔑 Login ke Sistem

1. Buka halaman login di `/login`
2. Masukkan username/email dan password
3. Pilih "Ingat saya" jika ingin mengingat akun
4. Klik tombol "Masuk"
5. Sistem akan redirect otomatis berdasarkan role:
    - **Admin** → Dashboard Admin (`/dashboard`)
    - **Siswa** → Dashboard Siswa (`/student/dashboard`)

**Demo Credentials:**

```
Admin:
- Username: admin
- Password: password

Siswa:
- Username: siswa
- Password: password
```

### 👤 Register Akun Baru (Siswa)

1. Klik link "Daftar sekarang" di halaman login
2. Isi form registrasi:
    - **Nama Lengkap**: Nama siswa (minimal 3 karakter)
    - **NIS**: Nomor Induk Siswa (numeric only, unique)
    - **Kelas**: Pilih kelas (10, 11, atau 12)
    - **Username**: Username unik (alphanumeric, 4-50 karakter)
    - **Email**: Email unik
    - **Password**: Minimal 8 karakter (lihat strength meter)
    - **Konfirmasi Password**: Harus sama dengan password
3. Lihat password strength meter untuk validasi password
4. Check "Saya setuju dengan syarat & ketentuan"
5. Klik tombol "Daftar Sekarang"
6. Auto-login dan redirect ke dashboard siswa

### 📊 Menggunakan Dashboard Admin

**Sidebar Navigation:**

- **Dashboard**: Halaman utama dengan statistik & chart
- **Pengaduan Masuk**: Daftar pengaduan status pending
- **Sedang Diproses**: Daftar pengaduan sedang ditangani
- **Selesai**: Daftar pengaduan yang sudah ditangani
- **Data Siswa**: List semua siswa
- **Laporan**: Laporan statistik
- **Pengaturan**: Konfigurasi sistem
- **Logout**: Keluar dari sistem

**Features:**

- Klik notifikasi bell untuk melihat notifikasi terbaru
- Klik profile dropdown untuk profile & settings
- Gunakan dark mode toggle untuk dark mode
- Klik hamburger menu untuk collapse sidebar
- Hover cards untuk lihat detail lebih

### 🎓 Menggunakan Dashboard Siswa

**Sidebar Navigation:**

- **Dashboard**: Halaman utama dengan statistik pengaduan
- **Buat Pengaduan**: Form untuk membuat pengaduan baru
- **Riwayat Pengaduan**: List pengaduan yang telah dibuat
- **Profile**: Edit profile siswa
- **Logout**: Keluar dari sistem

**Quick Form:**

- Di dashboard, gunakan "Buat Pengaduan Cepat"
- Isi Judul, Kategori, dan Deskripsi
- Klik "Kirim Pengaduan"

**Monitoring Pengaduan:**

- Lihat status real-time di tabel riwayat
- Monitor progress dengan progress bar
- Klik icon mata untuk detail pengaduan

### 🌙 Menggunakan Dark Mode

1. Klik icon moon di top navbar
2. Sistem akan switch ke dark mode dengan smooth transition
3. Preference disimpan di localStorage
4. Dark mode akan tetap aktif saat reload page

---

## 🗄️ Struktur Database

### Tabel: users

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NULLABLE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    role VARCHAR(255) DEFAULT 'siswa',
    nis VARCHAR(255) UNIQUE NULLABLE,
    kelas VARCHAR(255) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Relationships:

- **Users** → **Pengaduan** (One-to-Many)
- User bisa membuat multiple pengaduan

---

## 🔗 API & Routes

### Auth Routes

```
GET  /login                    → Tampilkan halaman login
POST /login                    → Proses login
GET  /register                 → Tampilkan halaman register
POST /register                 → Proses registrasi
POST /logout                   → Logout (protected)
```

### Admin Routes

```
GET  /dashboard                → Dashboard admin (protected)
GET  /admin/siswa              → Daftar siswa
GET  /admin/pengaduan/masuk    → Pengaduan pending
GET  /admin/pengaduan/diproses → Pengaduan diproses
GET  /admin/pengaduan/selesai  → Pengaduan selesai
GET  /admin/laporan            → Laporan
GET  /admin/settings           → Pengaturan
```

### Student Routes

```
GET  /student/dashboard        → Dashboard siswa (protected)
GET  /student/buat-pengaduan   → Form buat pengaduan
POST /student/pengaduan        → Submit pengaduan
GET  /student/riwayat          → Riwayat pengaduan
GET  /student/pengaduan/{id}   → Detail pengaduan
```

---

## ⚙️ Customization

### 1. Mengubah Warna Primary

Edit `public/css/dashboard.css` & `public/css/auth.css`:

```css
:root {
    --primary-color: #0a47a8; /* Ubah warna primary */
    --secondary-color: #1565d8; /* Ubah warna secondary */
}
```

### 2. Mengubah Logo/Brand

Edit halaman `.blade.php`:

```html
<div class="logo-circle">🎓</div>
<!-- Ubah icon -->
<h1>STUDY LEVEL</h1>
<!-- Ubah nama -->
```

### 3. Menambah Navigation Item

Edit `sidebar` di dashboard template:

```html
<a href="#" class="nav-item">
    <i class="fas fa-icon"></i>
    <span>Menu Item</span>
</a>
```

### 4. Mengubah Chart Data

Edit `public/js/dashboard.js`:

```javascript
data: {
    labels: ['Jan', 'Feb', ...],
    datasets: [{
        data: [12, 19, 15, ...],  // Ubah data
        backgroundColor: '#0a47a8'
    }]
}
```

### 5. Menambah Validasi Register

Edit `app/Http/Controllers/AuthController.php`:

```php
$validated = $request->validate([
    'nama' => 'required|string|min:3',
    // Tambah rule tambahan di sini
]);
```

### 6. Customizing Error Messages

Edit validation rules di `AuthController@register`:

```php
'nama.required' => 'Nama tidak boleh kosong!',
// Tambah pesan custom lainnya
```

---

## 🐛 Troubleshooting

### Issue: Database columns tidak ada

**Solusi:**

```bash
php artisan migrate:refresh
```

### Issue: CSS/JS tidak load

**Solusi:**

```bash
php artisan config:cache
php artisan view:clear
```

### Issue: Login gagal dengan credentials benar

**Solusi:**

1. Pastikan password di-hash dengan `bcrypt()`
2. Check role di database
3. Clear session: `php artisan session:clear`

### Issue: Chart tidak menampilkan

**Solusi:**

- Pastikan Chart.js sudah loaded
- Check console untuk error
- Pastikan canvas element ada: `<canvas id="barChart"></canvas>`

### Issue: Dark mode tidak persist

**Solusi:**

- Check localStorage: `localStorage.getItem('darkMode')`
- Clear browser cache

---

## 📚 Resource Links

- **Bootstrap 5**: https://getbootstrap.com/docs/5.3/
- **Font Awesome**: https://fontawesome.com/icons
- **Chart.js**: https://www.chartjs.org/docs/latest/
- **AOS**: https://michalsnik.github.io/aos/
- **Laravel Docs**: https://laravel.com/docs/11.x

---

## 📝 Notes

### Security

- ✅ CSRF protection dengan @csrf
- ✅ Password hashing dengan bcrypt
- ✅ SQL injection prevention dengan Eloquent
- ✅ XSS protection dengan Blade escaping
- ✅ Role-based access control

### Performance

- ✅ Lazy loading untuk images
- ✅ Compressed CSS/JS
- ✅ Chart.js caching
- ✅ LocalStorage untuk preferences

### Browser Support

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+

---

## 👨‍💻 Developer Notes

### File Locations

```
resources/views/
├── auth/
│   ├── login.blade.php          ← Halaman login
│   └── register.blade.php       ← Halaman register
├── admin/
│   └── dashboard.blade.php      ← Dashboard admin
└── student/
    └── dashboard-modern.blade.php ← Dashboard siswa

public/
├── css/
│   ├── auth.css                 ← CSS auth pages
│   └── dashboard.css            ← CSS dashboard
└── js/
    ├── auth.js                  ← JS auth pages
    └── dashboard.js             ← JS dashboard

app/Http/Controllers/
└── AuthController.php           ← Auth logic

routes/
└── web.php                      ← Route definitions

database/migrations/
└── 0001_01_01_000000_create_users_table.php
```

---

## 📞 Support

Untuk bantuan lebih lanjut atau issue:

1. Check documentation di atas
2. Check browser console untuk error
3. Check Laravel logs di `storage/logs/`
4. Periksa database columns dengan: `php artisan tinker` → `\DB::select('SHOW COLUMNS FROM users')`

---

**Terakhir Diupdate**: April 17, 2026

© 2026 Sistem Pengaduan Siswa - All Rights Reserved
