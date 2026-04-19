<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <style>
        .student-dashboard {
            background: #f8f9fa;
        }
        
        .student-dashboard.dark-mode {
            background: #0f0f1e;
        }
    </style>
</head>
<body class="dashboard-body student-dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-box">
                    <i class="fas fa-book"></i>
                </div>
                <h4>STUDY LEVEL</h4>
                <p class="sidebar-subtitle">Dashboard Siswa</p>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <span class="nav-section-title">MENU</span>
                    <a href="#" class="nav-item active" data-page="dashboard">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <a href="#" class="nav-item" data-page="buat-pengaduan">
                        <i class="fas fa-plus-circle"></i>
                        <span>Buat Pengaduan</span>
                    </a>
                    <a href="#" class="nav-item" data-page="riwayat">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Pengaduan</span>
                    </a>
                </div>

                <div class="nav-section">
                    <span class="nav-section-title">AKUN</span>
                    <a href="#" class="nav-item" data-page="profile">
                        <i class="fas fa-user-circle"></i>
                        <span>Profile</span>
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="user-profile">
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
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="navbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="breadcrumb-nav">
                        <span class="breadcrumb-item">Dashboard</span>
                        <span class="breadcrumb-separator">/</span>
                        <span class="breadcrumb-item active">Siswa</span>
                    </div>
                </div>

                <div class="navbar-right">
                    <!-- Dark Mode Toggle -->
                    <button class="dark-mode-toggle" id="darkModeToggle">
                        <i class="fas fa-moon"></i>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown">
                        <button class="profile-btn">
                            <div class="profile-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>{{ Auth::user()->nama ?? 'Siswa' }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Profile
                            </a>
                            <hr class="dropdown-divider">
                            <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="page-title">Dashboard Saya</h2>
                        <p class="page-subtitle">Pantau status pengaduan Anda di sini</p>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card" data-aos="fade-up">
                        <div class="stat-card-body">
                            <div class="stat-icon stat-icon-primary">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Total Pengaduan</p>
                                <h3 class="stat-value">12</h3>
                                <span class="stat-trend trend-neutral">
                                    Pengaduan yang telah dibuat
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-card-body">
                            <div class="stat-icon stat-icon-info">
                                <i class="fas fa-hourglass-start"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Pending</p>
                                <h3 class="stat-value">2</h3>
                                <span class="stat-trend trend-neutral">
                                    Menunggu ditinjau
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-card-body">
                            <div class="stat-icon stat-icon-warning">
                                <i class="fas fa-spinner"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Diproses</p>
                                <h3 class="stat-value">5</h3>
                                <span class="stat-trend trend-neutral">
                                    Sedang ditangani
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-card-body">
                            <div class="stat-icon stat-icon-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-info">
                                <p class="stat-label">Selesai</p>
                                <h3 class="stat-value">5</h3>
                                <span class="stat-trend trend-neutral">
                                    Sudah ditangani
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Form Section -->
                <div class="charts-grid">
                    <!-- Status Chart -->
                    <div class="chart-card" data-aos="fade-up">
                        <div class="chart-header">
                            <h5 class="chart-title">
                                <i class="fas fa-chart-pie"></i> Status Pengaduan Anda
                            </h5>
                        </div>
                        <div class="chart-body">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>

                    <!-- Quick Form -->
                    <div class="chart-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="chart-header">
                            <h5 class="chart-title">
                                <i class="fas fa-pen"></i> Buat Pengaduan Baru
                            </h5>
                        </div>
                        <div class="chart-body" style="padding: 20px;">
                            <form action="#" method="POST" class="quick-form">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul Pengaduan</label>
                                    <input type="text" class="form-control form-input-modern" placeholder="Judul singkat pengaduan">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-control form-input-modern">
                                        <option>Pilih Kategori</option>
                                        <option>Fasilitas</option>
                                        <option>Guru</option>
                                        <option>Pembelajaran</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea class="form-control form-input-modern" rows="3" placeholder="Jelaskan masalahnya..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Recent Complaints -->
                <div class="table-card" data-aos="fade-up">
                    <div class="table-header">
                        <h5 class="table-title">
                            <i class="fas fa-list"></i> Riwayat Pengaduan Terbaru
                        </h5>
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
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>15 Apr 2026</small></td>
                                    <td>AC di Ruang Kelas Tidak Dingin</td>
                                    <td><span class="badge bg-light text-dark">Iklim</span></td>
                                    <td><span class="badge bg-warning">Diproses</span></td>
                                    <td>
                                        <div class="progress" style="height: 18px;">
                                            <div class="progress-bar" style="width: 75%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
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
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>13 Apr 2026</small></td>
                                    <td>Meja Sekolah Rusak</td>
                                    <td><span class="badge bg-light text-dark">Mebel</span></td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <div class="progress" style="height: 18px;">
                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tips Section -->
                <div class="alert alert-info alert-dismissible fade show" data-aos="fade-up" role="alert">
                    <i class="fas fa-lightbulb"></i>
                    <strong>Tips:</strong> Setiap pengaduan yang Anda kirimkan akan ditinjau oleh tim admin dalam waktu maksimal 2x24 jam. Silakan pantau status pengaduan Anda secara berkala.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        // Initialize Status Chart
        const statusCtx = document.getElementById('statusChart');
        if (statusCtx && typeof Chart !== 'undefined') {
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Diproses', 'Selesai'],
                    datasets: [{
                        data: [2, 5, 5],
                        backgroundColor: [
                            '#17a2b8',
                            '#ffc107',
                            '#28a745'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                usePointStyle: true,
                                padding: 15,
                                font: {
                                    size: 12,
                                    weight: 500
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
