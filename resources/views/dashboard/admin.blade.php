<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Pengaduan Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        body.dark-mode {
            background-color: #1a1a2e;
        }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-box">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="brand-name">STUDY LEVEL</h3>
                <p class="brand-tagline">Admin Dashboard</p>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-group">
                    <span class="nav-group-title">MAIN</span>
                    <a href="#" class="nav-link active">
                        <i class="fas fa-chart-line"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>

                <div class="nav-group">
                    <span class="nav-group-title">PENGADUAN</span>
                    <a href="#" class="nav-link">
                        <i class="fas fa-inbox"></i>
                        <span class="nav-text">Pengaduan Masuk</span>
                        <span class="badge bg-danger">5</span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-spinner"></i>
                        <span class="nav-text">Sedang Diproses</span>
                        <span class="badge bg-warning">12</span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-check-circle"></i>
                        <span class="nav-text">Selesai</span>
                        <span class="badge bg-success">45</span>
                    </a>
                </div>

                <div class="nav-group">
                    <span class="nav-group-title">DATA</span>
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Data Siswa</span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Laporan</span>
                    </a>
                </div>

                <div class="nav-group">
                    <span class="nav-group-title">SISTEM</span>
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span class="nav-text">Pengaturan</span>
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <p class="user-name">{{ Auth::user()->nama ?? 'Admin' }}</p>
                        <p class="user-role">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                    @csrf
                    <button type="submit" class="btn-logout w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navbar -->
            <header class="top-navbar">
                <div class="navbar-left">
                    <button class="btn-sidebar-toggle" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="breadcrumb-area">
                        <span>Dashboard</span>
                        <span class="separator">/</span>
                        <span class="active">Admin</span>
                    </div>
                </div>

                <div class="navbar-right">
                    <!-- Notifications -->
                    <div class="notification-box">
                        <button class="btn-notification" id="notificationBtn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        <div class="notification-dropdown" id="notificationDropdown">
                            <div class="dropdown-header">Notifikasi</div>
                            <div class="notification-item">
                                <i class="fas fa-warning text-warning"></i>
                                <div>
                                    <p>Pengaduan baru masuk</p>
                                    <small>5 menit lalu</small>
                                </div>
                            </div>
                            <div class="notification-item">
                                <i class="fas fa-check text-success"></i>
                                <div>
                                    <p>Pengaduan selesai ditangani</p>
                                    <small>1 jam lalu</small>
                                </div>
                            </div>
                            <div class="notification-item">
                                <i class="fas fa-info text-info"></i>
                                <div>
                                    <p>Siswa baru terdaftar</p>
                                    <small>2 jam lalu</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dark Mode Toggle -->
                    <button class="btn-dark-mode" id="darkModeBtn" title="Toggle Dark Mode">
                        <i class="fas fa-moon"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown">
                        <button class="btn-profile" id="profileBtn">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama ?? 'Admin' }}&background=0d5ac3&color=fff" alt="Profile" class="profile-img">
                            <span>{{ Auth::user()->nama ?? 'Admin' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" id="profileMenu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <hr class="dropdown-divider">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Header -->
                <div class="content-header">
                    <div>
                        <h1 class="page-title">Dashboard Admin</h1>
                        <p class="page-subtitle">Selamat datang kembali, {{ Auth::user()->nama ?? 'Admin' }}!</p>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-download"></i> Export Data
                    </button>
                </div>

                <!-- Statistics Grid -->
                <div class="stats-grid" id="statsGrid">
                    <div class="stat-card card-primary" data-aos="fade-up">
                        <div class="stat-body">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Total Pengaduan</p>
                                <h3 class="stat-value">128</h3>
                                <span class="stat-trend up"><i class="fas fa-arrow-up"></i> +12%</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-warning" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-body">
                            <div class="stat-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Sedang Diproses</p>
                                <h3 class="stat-value">24</h3>
                                <span class="stat-trend neutral"><i class="fas fa-clock"></i> 2 hari rata-rata</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-success" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-body">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Selesai</p>
                                <h3 class="stat-value">98</h3>
                                <span class="stat-trend neutral">76.6% penyelesaian</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-info" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-body">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Total Siswa</p>
                                <h3 class="stat-value">342</h3>
                                <span class="stat-trend up"><i class="fas fa-arrow-up"></i> +5 siswa</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-section">
                    <div class="row g-4">
                        <!-- Bar Chart -->
                        <div class="col-lg-8" data-aos="fade-up">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h5>Pengaduan Per Bulan</h5>
                                    <select class="form-select form-select-sm">
                                        <option>2026</option>
                                        <option>2025</option>
                                    </select>
                                </div>
                                <div class="chart-body">
                                    <canvas id="barChart" height="80"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h5>Status Pengaduan</h5>
                                </div>
                                <div class="chart-body">
                                    <canvas id="pieChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Line Chart -->
                    <div class="row g-4 mt-1">
                        <div class="col-12" data-aos="fade-up">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h5>Aktivitas Harian (7 Hari Terakhir)</h5>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-refresh"></i> Refresh
                                    </button>
                                </div>
                                <div class="chart-body">
                                    <canvas id="lineChart" height="60"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Table -->
                <div class="table-card" data-aos="fade-up">
                    <div class="table-header">
                        <h5>Pengaduan Terbaru</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Siswa</th>
                                    <th>Judul Pengaduan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><small>16 Apr 2026</small></td>
                                    <td>Ahmad Surya</td>
                                    <td>Fasilitas Toilet Kurang Bersih</td>
                                    <td><span class="badge bg-warning text-dark">Diproses</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>15 Apr 2026</small></td>
                                    <td>Siti Nur Azizah</td>
                                    <td>AC Ruang Kelas Tidak Dingin</td>
                                    <td><span class="badge bg-warning text-dark">Diproses</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>14 Apr 2026</small></td>
                                    <td>Budi Santoso</td>
                                    <td>Lampu Putus di Koridor</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>13 Apr 2026</small></td>
                                    <td>Rina Wijaya</td>
                                    <td>Meja Sekolah Rusak</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Initialize Charts
        document.addEventListener('DOMContentLoaded', function() {
            initAdminCharts();
        });

        function initAdminCharts() {
            // Bar Chart
            const barCtx = document.getElementById('barChart');
            if (barCtx) {
                new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Pengaduan',
                            data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 28, 25, 22],
                            backgroundColor: '#0a47a8',
                            borderRadius: 8,
                            hoverBackgroundColor: '#0d5ac3'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }

            // Pie Chart
            const pieCtx = document.getElementById('pieChart');
            if (pieCtx) {
                new Chart(pieCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pending', 'Diproses', 'Selesai'],
                        datasets: [{
                            data: [6, 24, 98],
                            backgroundColor: ['#dc3545', '#ffc107', '#28a745'],
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }

            // Line Chart
            const lineCtx = document.getElementById('lineChart');
            if (lineCtx) {
                new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        datasets: [{
                            label: 'Pengaduan',
                            data: [12, 15, 10, 18, 22, 8, 5],
                            borderColor: '#0a47a8',
                            backgroundColor: 'rgba(10, 71, 168, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }
        }
    </script>
</body>
</html>
