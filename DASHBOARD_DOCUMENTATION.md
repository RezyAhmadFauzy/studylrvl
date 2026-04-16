# 📊 Dashboard Sistem Pengaduan Siswa - Dokumentasi Lengkap

## 🎯 Fitur Utama Dashboard

### 1. **Sidebar Navigasi (Collapsible)**

- Logo dan nama aplikasi
- Menu navigasi dengan icon:
    - Dashboard
    - Pengaduan
    - Siswa
    - Laporan
    - Pengaturan
    - Logout
- Responsive design yang collapse di mobile
- Active state indicator

### 2. **Navbar Top**

- Logo aplikasi
- Toggle button sidebar
- Notification dropdown (dengan badge counter)
- User profile dropdown
- Responsive layout

### 3. **Statistik Cards**

- **Total Pengaduan** - 128 pengaduan total
- **Sedang Diproses** - 24 pengaduan aktif
- **Selesai** - 98 pengaduan selesai
- **Total Siswa** - 342 siswa terdaftar

Setiap card menampilkan:

- Nilai statistik dengan animasi counter
- Icon dengan gradient background
- Trend indicator (naik/turun)
- Status informasi

### 4. **Grafik Interaktif (Chart.js)**

#### a) Bar Chart - Pengaduan Per Bulan

- Menampilkan data pengaduan 12 bulan terakhir
- Hover effect untuk detail data
- Responsive design

#### b) Pie Chart - Status Pengaduan

- Visualisasi status: Pending, Diproses, Selesai
- Warna berbeda untuk setiap status
- Legend yang informatif

#### c) Line Chart - Aktivitas Harian

- Data aktivitas 7 hari terakhir
- Smooth animation
- Point hover untuk detail

### 5. **Tabel Pengaduan Terbaru**

- List pengaduan terbaru dengan detail:
    - Tanggal
    - Nama Siswa
    - Judul Pengaduan
    - Status (badge color)
    - Action button

## 🎨 Desain & Styling

### Warna

- **Primary**: #0056b3 (Biru modern)
- **Success**: #28a745 (Hijau)
- **Warning**: #ffc107 (Kuning)
- **Danger**: #dc3545 (Merah)
- **Info**: #17a2b8 (Biru muda)

### Typography

- Font: Poppins (Google Fonts)
- Clean dan modern design
- Responsive typography

### Efek Visual

- Shadow cards yang subtle
- Hover animation pada cards
- Gradient backgrounds
- Smooth transitions
- Counter animation pada stats

## 📱 Responsive Breakpoints

| Device  | Width     | Layout                           |
| ------- | --------- | -------------------------------- |
| Mobile  | ≤480px    | Single column, collapsed sidebar |
| Tablet  | 481-768px | 2 columns, collapsible sidebar   |
| Desktop | >768px    | Full layout dengan sidebar       |

## 🛠️ Struktur File

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # Layout utama
│   ├── dashboard.blade.php         # Dashboard page
│   └── auth/
│       └── login.blade.php         # Login page
│
public/
├── css/
│   └── dashboard.css               # Custom styling
└── js/
    └── dashboard.js                # Interaktivitas
```

## 🚀 Fitur JavaScript

### Sidebar Toggle

- Click button untuk membuka/tutup sidebar
- Auto-close saat click outside di mobile
- Responsive behavior

### Notification System

- Dropdown notification dengan badge
- Animation pada hover
- Scroll pada list panjang

### Statistics Animation

- Counter animation saat page load
- Intersection Observer untuk lazy animation
- Smooth number increment

### Table Interaction

- Row hover effect
- Responsive table dengan scroll

### Utility Functions

```javascript
// Alert
Dashboard.showAlert("Message", "info", 5000);

// Export CSV
Dashboard.exportToCSV("tableId", "filename.csv");

// Print
Dashboard.printDashboard();

// Device Detection
Dashboard.isMobile(); // true/false
Dashboard.isTablet(); // true/false
Dashboard.isDesktop(); // true/false
```

## 📊 Data Format

### Chart Data Structure

```javascript
{
  labels: [...],
  datasets: [{
    label: 'Name',
    data: [...]
  }]
}
```

### Table Data Format

```html
<table class="table">
    <thead>
        <tr class="bg-light">
            <th>Column</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Data</td>
        </tr>
    </tbody>
</table>
```

## 🔄 Integrasi dengan Laravel

### Routes

```php
// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
```

### Controller Integration

```php
// Mengirim data ke view
return view('dashboard', [
    'total_pengaduan' => 128,
    'diproses' => 24,
    'selesai' => 98
]);
```

## 💾 Database Integration

Untuk koneksi dengan database:

```php
// Di Dashboard controller
$statistics = [
    'total' => Pengaduan::count(),
    'diproses' => Pengaduan::where('status', 'diproses')->count(),
    'selesai' => Pengaduan::where('status', 'selesai')->count(),
    'siswa' => User::count()
];

// Di view
{{ $statistics['total'] }}
```

## 🎯 Customization

### Mengubah Warna Primary

Ubah di `dashboard.css`:

```css
:root {
    --primary-color: #0056b3; /* Ubah ke warna yang diinginkan */
}
```

### Menambah Menu Sidebar

Di `app.blade.php`:

```html
<a href="{{ route('menu.name') }}" class="nav-item">
    <i class="fas fa-icon"></i>
    <span>Menu Name</span>
</a>
```

### Mengubah Chart Data

Di `dashboard.blade.php`:

```javascript
data: [12, 19, 15, 25, ...] // Ubah dengan data real
```

## ⚡ Performance Tips

1. **Lazy Loading Charts**: Charts hanya render ketika visible
2. **CSS Optimization**: Menggunakan Bootstrap grid system
3. **Smooth Animations**: Hardware-accelerated CSS transforms
4. **Responsive Images**: SVG icons dari Font Awesome

## 🔐 Security

- Login required untuk akses dashboard
- Session protection
- CSRF protection via @csrf
- Sanitized output menggunakan Blade escaping

## 📝 Maintenance

### Update Chart Data

- Real-time: Gunakan AJAX untuk update periodic
- Static: Update langsung di dashboard.blade.php

### Menambah Statistik Baru

1. Tambah card di HTML
2. Styling sesuai dengan stat-card class
3. Update JavaScript untuk animation

### Error Handling

```javascript
try {
    // Chart initialization
} catch (error) {
    console.error("Chart error:", error);
}
```

## 🎓 Learning Resources

- Bootstrap 5: https://getbootstrap.com/docs/5.0/
- Chart.js: https://www.chartjs.org/
- Font Awesome: https://fontawesome.com/
- Laravel Blade: https://laravel.com/docs/blade

## 📞 Support

Untuk pertanyaan atau bantuan:

- Cek dokumentasi resmi
- Lihat contoh di codebase
- Debug via browser console

---

**Version**: 1.0  
**Last Updated**: April 2026  
**Created for**: Sistem Pengaduan Siswa
