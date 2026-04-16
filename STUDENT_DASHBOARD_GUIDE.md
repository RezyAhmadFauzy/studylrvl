# 📱 Dashboard Siswa - Sistem Pengaduan Lengkap

## 🎯 Fitur Utama Dashboard Siswa

### 1. **Sidebar Menu**

✅ Dashboard - Halaman utama dengan statistik
✅ Buat Pengaduan - Form untuk membuat pengaduan baru
✅ Riwayat Pengaduan - Daftar semua pengaduan yang dibuat
✅ Profile - Informasi profil siswa
✅ Logout - Keluar dari aplikasi

### 2. **Dashboard Siswa**

✅ **4 Statistics Cards:**

- Total Pengaduan Saya (jumlah total)
- Pengaduan Pending (menunggu ditinjau)
- Pengaduan Diproses (sedang ditangani)
- Pengaduan Selesai (sudah ditangani)

✅ **Grafik Status Pengaduan:**

- Pie Chart dengan Chart.js
- Visualisasi status real-time
- Warna berbeda untuk setiap status

✅ **Form Pengaduan Cepat:**

- Input judul & deskripsi
- Upload foto/bukti
- Submit langsung dari dashboard

✅ **Tabel Pengaduan Terbaru:**

- 5 pengaduan terbaru
- Status dengan badge warna
- Link ke detail pengaduan

### 3. **Halaman Buat Pengaduan**

✅ Form lengkap dengan validasi
✅ Character counter untuk deskripsi
✅ File upload dengan drag & drop
✅ Preview gambar sebelum upload
✅ Info box dengan petunjuk pengisian

### 4. **Halaman Riwayat Pengaduan**

✅ List semua pengaduan siswa
✅ Filter berdasarkan status
✅ Sorting (terbaru/terlama)
✅ Search/pencarian pengaduan
✅ Pagination untuk navigasi

### 5. **Halaman Detail Pengaduan**

✅ Informasi lengkap pengaduan
✅ Status timeline (riwayat status)
✅ Foto/bukti pengaduan
✅ Informasi pelapor
✅ Action buttons

---

## 🎨 Design & Styling

### Warna Profesional

```
Primary: #0056b3 (Biru Modern)
Pending: #dc3545 (Merah)
Diproses: #ffc107 (Kuning)
Selesai: #28a745 (Hijau)
Secondary: #6c757d (Abu-abu)
```

### Typography

- **Font**: Poppins (Google Fonts)
- **Responsive**: Semua ukuran layar
- **Modern**: Clean & professional design

### Animasi & Efek

✅ Smooth transitions
✅ Hover effects pada cards
✅ Counter animation untuk statistik
✅ Loading states
✅ Page transitions

---

## 📊 Database Structure

### Tabel: pengaduan

```sql
CREATE TABLE pengaduan (
    id INT PRIMARY KEY,
    id_user INT (FK to users),
    judul VARCHAR(255),
    isi_laporan TEXT,
    foto VARCHAR(255) NULL,
    status ENUM('pending', 'diproses', 'selesai'),
    tanggal_lapor TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Status Pengaduan

- **Pending**: Pengaduan baru, menunggu ditinjau
- **Diproses**: Tim sedang menangani
- **Selesai**: Pengaduan sudah ditangani

---

## 🚀 Setup & Installation

### 1. Jalankan Migrasi

```bash
php artisan migrate
```

### 2. Seed Database

```bash
php artisan db:seed
```

Demo Users:

- **Admin**: username: `admin`, password: `password123`
- **User**: username: `user`, password: `user123`

### 3. Jalankan Server

```bash
php artisan serve
```

### 4. Akses Student Dashboard

```
URL: http://localhost:8000
Login dengan user biasa
Akan redirect ke: http://localhost:8000/student/dashboard
```

---

## 📁 File Structure

```
resources/views/
├── layouts/
│   └── student.blade.php          # Master layout siswa
├── student/
│   ├── dashboard.blade.php        # Dashboard siswa
│   ├── buat-pengaduan.blade.php   # Form buat pengaduan
│   ├── riwayat-pengaduan.blade.php # Riwayat pengaduan
│   └── detail-pengaduan.blade.php # Detail pengaduan

app/
├── Models/
│   └── Pengaduan.php              # Model pengaduan
├── Http/Controllers/
│   └── PengaduanController.php    # Controller pengaduan

public/
├── css/
│   └── student-dashboard.css      # Styling
├── js/
│   └── student-dashboard.js       # JavaScript
└── uploads/
    └── pengaduan/                 # Folder untuk foto
```

---

## 🔧 Features & Functions

### StudentDashboard Object

```javascript
// Logout
StudentDashboard.logout();

// Refresh data
StudentDashboard.refreshData();

// Show notification
StudentDashboard.showNotification("Message", "info");

// Export to CSV
StudentDashboard.exportToCSV("tableId", "filename.csv");

// Print page
StudentDashboard.printPage();

// Device detection
StudentDashboard.isMobile();
StudentDashboard.isTablet();
StudentDashboard.isDesktop();

// Toggle sidebar
StudentDashboard.toggleSidebar();
```

---

## 📱 Responsive Design

| Device  | Width     | Layout                           |
| ------- | --------- | -------------------------------- |
| Mobile  | ≤480px    | Single column, collapsed sidebar |
| Tablet  | 481-768px | 2 columns, toggle sidebar        |
| Desktop | >768px    | Full layout dengan sidebar       |

---

## ✅ Form Validasi

### Buat Pengaduan

- ✅ Judul: Required, Max 255 chars
- ✅ Isi Laporan: Required, Min 10 chars
- ✅ Foto: Optional, Max 2MB, Image only

### Error Handling

- ✅ Inline validation messages
- ✅ Form feedback visual
- ✅ Success notifications

---

## 🔐 Security

✅ Autentikasi Required
✅ Authorization Check (User hanya bisa lihat pengaduannya)
✅ CSRF Protection (@csrf)
✅ Password Hashing (bcrypt)
✅ File Upload Validation

---

## 🎓 Integrasi dengan Controller

### PengaduanController Methods

```php
// Get student dashboard
studentDashboard()

// Show form create
create()

// Store pengaduan
store(Request $request)

// Get history
history()

// Show detail
show(Pengaduan $pengaduan)

// Admin dashboard
adminDashboard()

// Update status (admin only)
updateStatus(Request $request, Pengaduan $pengaduan)
```

---

## 📊 Chart.js Integration

### Status Chart

```javascript
const statusChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Pending", "Diproses", "Selesai"],
        datasets: [
            {
                data: [pending, diproses, selesai],
                backgroundColor: ["#dc3545", "#ffc107", "#28a745"],
            },
        ],
    },
});
```

---

## 🎨 Customization

### Ubah Warna Primary

File: `public/css/student-dashboard.css`

```css
:root {
    --primary: #0056b3; /* Ubah warna di sini */
}
```

### Tambah Menu Sidebar

File: `resources/views/layouts/student.blade.php`

```html
<a href="{{ route('route-name') }}" class="nav-item">
    <i class="fas fa-icon"></i>
    <span>Menu Name</span>
</a>
```

### Ubah Statistik

File: `resources/views/student/dashboard.blade.php`

```php
// Update dari controller dengan data real
$totalPengaduan = Pengaduan::byUser(Auth::id())->count();
```

---

## 🐛 Troubleshooting

| Issue                | Solusi                                              |
| -------------------- | --------------------------------------------------- |
| 404 Not Found        | Pastikan routes sudah benar di `routes/web.php`     |
| Foto tidak upload    | Check folder permissions `public/uploads/pengaduan` |
| Chart tidak tampil   | Pastikan Chart.js CDN terload                       |
| Sidebar tidak toggle | Clear cache browser & hard refresh                  |
| Database error       | Run `php artisan migrate:fresh --seed`              |

---

## 🚀 Performance Tips

1. **Lazy Loading**: Charts render hanya saat visible
2. **Pagination**: Riwayat pengaduan per 10 items
3. **Query Optimization**: Gunakan relationship eager loading
4. **Caching**: Cache statistik user
5. **Compression**: Minify CSS & JS files

---

## 📞 Support & Help

- Cek dokumentasi Laravel: https://laravel.com/docs
- Chart.js Docs: https://www.chartjs.org/
- Bootstrap 5: https://getbootstrap.com/docs/5.0/
- Font Awesome: https://fontawesome.com/

---

## 📝 Version History

**Version 1.0** - April 2026

- Initial release
- Complete student dashboard
- Complaint system
- File upload support
- Responsive design

---

**Status**: ✅ Production Ready
**Created**: April 2026
**Updated**: April 2026
