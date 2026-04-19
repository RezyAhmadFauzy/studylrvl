<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-box">
                    <i class="fas fa-book"></i>
                </div>
                <h3 class="brand-name">STUDY LEVEL</h3>
                <p class="brand-tagline">Dashboard Siswa</p>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-group">
                    <span class="nav-group-title">MENU</span>
                    <a href="#" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-plus-circle"></i>
                        <span class="nav-text">Buat Pengaduan</span>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-history"></i>
                        <span class="nav-text">Riwayat Pengaduan</span>
                    </a>
                </div>

                <div class="nav-group">
                    <span class="nav-group-title">AKUN</span>
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-circle"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <p class="user-name">{{ Auth::user()->nama ?? 'Siswa' }}</p>
                        <p class="user-role">Siswa</p>
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
                        <span class="active">Siswa</span>
                    </div>
                </div>

                <div class="navbar-right">
                    <!-- Dark Mode Toggle -->
                    <button class="btn-dark-mode" id="darkModeBtn" title="Toggle Dark Mode">
                        <i class="fas fa-moon"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown">
                        <button class="btn-profile" id="profileBtn">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama ?? 'Siswa' }}&background=0d5ac3&color=fff" alt="Profile" class="profile-img">
                            <span>{{ Auth::user()->nama ?? 'Siswa' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" id="profileMenu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user"></i> Profile
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
                        <h1 class="page-title">Dashboard Saya</h1>
                        <p class="page-subtitle">Pantau status pengaduan Anda di sini</p>
                    </div>
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
                                <h3 class="stat-value">12</h3>
                                <span class="stat-trend neutral">Semua pengaduan</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-info" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-body">
                            <div class="stat-icon">
                                <i class="fas fa-hourglass-start"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Pending</p>
                                <h3 class="stat-value">2</h3>
                                <span class="stat-trend neutral">Menunggu ditinjau</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-warning" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-body">
                            <div class="stat-icon">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Diproses</p>
                                <h3 class="stat-value">5</h3>
                                <span class="stat-trend neutral">Sedang ditangani</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card card-success" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-body">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Selesai</p>
                                <h3 class="stat-value">5</h3>
                                <span class="stat-trend neutral">Sudah ditangani</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-section">
                    <div class="row g-4">
                        <!-- Status Chart -->
                        <div class="col-lg-6" data-aos="fade-up">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h5>Status Pengaduan Anda</h5>
                                </div>
                                <div class="chart-body">
                                    <canvas id="statusChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Form -->
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="chart-card">
                                <div class="chart-header">
                                    <h5>Buat Pengaduan Baru</h5>
                                </div>
                                <div class="chart-body">
                                    <form class="quick-form">
                                        <div class="mb-3">
                                            <label class="form-label">Judul</label>
                                            <input type="text" class="form-control" placeholder="Judul pengaduan">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-select">
                                                <option>Pilih Kategori</option>
                                                <option>Fasilitas</option>
                                                <option>Guru</option>
                                                <option>Pembelajaran</option>
                                                <option>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea class="form-control" rows="2" placeholder="Jelaskan masalahnya..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Complaints -->
                <div class="table-card" data-aos="fade-up">
                    <div class="table-header">
                        <h5>Riwayat Pengaduan Terbaru</h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Progres</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><small>16 Apr 2026</small></td>
                                    <td>Fasilitas Toilet Kurang Bersih</td>
                                    <td><span class="badge bg-light text-dark">Fasilitas</span></td>
                                    <td><span class="badge bg-warning">Diproses</span></td>
                                    <td>
                                        <div class="progress" style="height: 18px;">
                                            <div class="progress-bar" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>15 Apr 2026</small></td>
                                    <td>AC Ruang Kelas Tidak Dingin</td>
                                    <td><span class="badge bg-light text-dark">Iklim</span></td>
                                    <td><span class="badge bg-warning">Diproses</span></td>
                                    <td>
                                        <div class="progress" style="height: 18px;">
                                            <div class="progress-bar" style="width: 75%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>14 Apr 2026</small></td>
                                    <td>Lampu Putus di Koridor</td>
                                    <td><span class="badge bg-light text-dark">Listrik</span></td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <div class="progress" style="height: 18px;">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                    </td>
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

                <!-- Info Alert -->
                <div class="alert alert-info alert-dismissible fade show" data-aos="fade-up" role="alert">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Tips:</strong> Setiap pengaduan ditinjau maksimal 2x24 jam. Pantau status pengaduan Anda secara berkala.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
            initSiswaCharts();
        });

        function initSiswaCharts() {
            // Status Chart
            const statusCtx = document.getElementById('statusChart');
            if (statusCtx) {
                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Pending', 'Diproses', 'Selesai'],
                        datasets: [{
                            data: [2, 5, 5],
                            backgroundColor: ['#17a2b8', '#ffc107', '#28a745'],
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
        }
    </script>
</body>
</html>
