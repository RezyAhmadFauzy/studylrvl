@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #051F20, #0B2B26); color: white; border-radius: 24px;">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="mb-2 fw-bold">Selamat Datang, {{ Auth::user()->nama }}! 👋</h2>
                            <p class="mb-4 opacity-75">Pantau pengaduan Anda dengan mudah. Sistem ini membantu Anda melacak progress setiap laporan yang diajukan.</p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="#" class="btn btn-light btn-modern">
                                    <i class="fas fa-plus me-2"></i>Ajukan Pengaduan
                                </a>
                                <a href="#" class="btn btn-outline-light btn-modern">
                                    <i class="fas fa-list me-2"></i>Lihat Pengaduan Saya
                                </a>
                                <a href="#" class="btn btn-outline-light btn-modern">
                                    <i class="fas fa-file-pdf me-2"></i>Download Laporan
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center d-none d-lg-block">
                            <div class="position-relative">
                                <div class="rounded-circle bg-white bg-opacity-20 d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                    <i class="fas fa-graduation-cap fs-1"></i>
                                </div>
                                <div class="mt-3">
                                    <h4 class="mb-1">Dashboard Siswa</h4>
                                    <p class="small opacity-75 mb-0">Sistem Pengaduan Online</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #8EB69B, #DAF1DE);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2 text-dark fw-semibold">Total Pengaduan</p>
                            <h3 class="stat-value mb-0 text-dark">128</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(5, 31, 32, 0.1); color: #051F20;">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                    <small class="text-success fw-semibold"><i class="fas fa-arrow-up me-1"></i>+12% dari bulan lalu</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #FFC107, #FFF3CD);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2 text-dark fw-semibold">Sedang Diproses</p>
                            <h3 class="stat-value mb-0 text-dark">24</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(255, 193, 7, 0.1); color: #856404;">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                    <small class="text-info fw-semibold"><i class="fas fa-clock me-1"></i>Rata-rata 2 hari</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #28A745, #D4EDDA);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2 text-dark fw-semibold">Selesai</p>
                            <h3 class="stat-value mb-0 text-dark">98</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(40, 167, 69, 0.1); color: #155724;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <small class="text-muted fw-semibold">76.6% tingkat penyelesaian</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #17A2B8, #D1ECF1);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2 text-dark fw-semibold">Total Siswa</p>
                            <h3 class="stat-value mb-0 text-dark">342</h3>
                        </div>
                        <div class="stat-icon" style="background: rgba(23, 162, 184, 0.1); color: #0C5460;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <small class="text-success fw-semibold"><i class="fas fa-arrow-up me-1"></i>+5 siswa baru</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Bar Chart -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-bottom px-4 py-3" style="border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 card-title fw-bold">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>Pengaduan Per Bulan
                    </h5>
                    <small class="text-muted">Statistik pengaduan Anda selama 12 bulan terakhir</small>
                </div>
                <div class="card-body p-4">
                    <canvas id="barChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-bottom px-4 py-3" style="border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 card-title fw-bold">
                        <i class="fas fa-chart-pie me-2 text-success"></i>Status Pengaduan
                    </h5>
                    <small class="text-muted">Distribusi status pengaduan Anda</small>
                </div>
                <div class="card-body p-4">
                    <canvas id="pieChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="row g-4 mb-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-bottom px-4 py-3" style="border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 card-title fw-bold">
                        <i class="fas fa-chart-line me-2 text-info"></i>Aktivitas Pengaduan Harian (7 Hari Terakhir)
                    </h5>
                    <small class="text-muted">Pantau aktivitas pengaduan Anda setiap hari</small>
                </div>
                <div class="card-body p-4">
                    <canvas id="lineChart" height="60"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints Table -->
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center" style="border-radius: 20px 20px 0 0;">
                    <div>
                        <h5 class="mb-0 card-title fw-bold">
                            <i class="fas fa-list me-2 text-warning"></i>Pengaduan Terbaru
                        </h5>
                        <small class="text-muted">Daftar pengaduan Anda yang terakhir diajukan</small>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i>Filter Status
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Semua Status</a></li>
                                <li><a class="dropdown-item" href="#">Pending</a></li>
                                <li><a class="dropdown-item" href="#">Diproses</a></li>
                                <li><a class="dropdown-item" href="#">Selesai</a></li>
                            </ul>
                        </div>
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Ajukan Baru
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 fw-bold">Tanggal</th>
                                    <th class="px-4 py-3 fw-bold">Judul Pengaduan</th>
                                    <th class="px-4 py-3 fw-bold">Status</th>
                                    <th class="px-4 py-3 fw-bold">Update Terakhir</th>
                                    <th class="px-4 py-3 fw-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">16 Apr 2026</div>
                                        <small class="text-muted">14:30 WIB</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">Fasilitas Toilet Kurang Bersih</div>
                                        <small class="text-muted">Kelas X IPA 1 - Toilet Lantai 2</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-warning px-3 py-2">
                                            <i class="fas fa-spinner me-1"></i>Diproses
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">17 Apr 2026</div>
                                        <small class="text-muted">Sedang dalam pengerjaan</small>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-success" title="Update">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" title="More Actions">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Cetak</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Bagikan</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">15 Apr 2026</div>
                                        <small class="text-muted">09:15 WIB</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">AC di Ruang Kelas Tidak Dingin</div>
                                        <small class="text-muted">Kelas X IPA 1 - Ruang 101</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-warning px-3 py-2">
                                            <i class="fas fa-spinner me-1"></i>Diproses
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">16 Apr 2026</div>
                                        <small class="text-muted">Teknisi sedang diperjalanan</small>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-success" title="Update">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" title="More Actions">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Cetak</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Bagikan</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">14 Apr 2026</div>
                                        <small class="text-muted">11:45 WIB</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">Lampu Putus di Koridor</div>
                                        <small class="text-muted">Kelas X IPA 1 - Koridor Lantai 1</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Selesai
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">15 Apr 2026</div>
                                        <small class="text-muted">Sudah diperbaiki</small>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-success" title="Update">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" title="More Actions">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Cetak</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Bagikan</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">13 Apr 2026</div>
                                        <small class="text-muted">08:20 WIB</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">Meja Sekolah Rusak</div>
                                        <small class="text-muted">Kelas X IPA 1 - Meja nomor 5</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Selesai
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">14 Apr 2026</div>
                                        <small class="text-muted">Meja sudah diganti</small>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-success" title="Update">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" title="More Actions">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Cetak</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Bagikan</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">12 Apr 2026</div>
                                        <small class="text-muted">13:10 WIB</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">Kurangnya Tempat Parkir</div>
                                        <small class="text-muted">Kelas X IPA 1 - Area parkir siswa</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-danger px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold">12 Apr 2026</div>
                                        <small class="text-muted">Menunggu ditinjau</small>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-success" title="Update">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" title="More Actions">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Cetak</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Bagikan</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"><i class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: rgba(0,0,0,0.7);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .btn-modern {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-modern:hover::before {
        left: 100%;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .badge {
        font-weight: 600;
        border-radius: 20px;
    }

    .table th {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .table td {
        vertical-align: middle;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-radius: 12px;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }
</style>
@endsection

@push('scripts')
<script>
    // Bar Chart - Pengaduan Per Bulan
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Total Pengaduan',
                data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 28, 25, 22],
                backgroundColor: '#8EB69B',
                borderColor: '#235347',
                borderWidth: 1,
                borderRadius: 8,
                hoverBackgroundColor: '#235347',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10
                    }
                }
            }
        }
    });

    // Pie Chart - Status Pengaduan
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Diproses', 'Selesai'],
            datasets: [{
                data: [6, 24, 98],
                backgroundColor: [
                    '#dc3545',
                    '#ffc107',
                    '#28a745'
                ],
                borderColor: '#fff',
                borderWidth: 3,
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
                        padding: 15
                    }
                }
            }
        }
    });

    // Line Chart - Aktivitas Harian
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Pengaduan Baru',
                data: [12, 15, 10, 18, 22, 8, 5],
                borderColor: '#235347',
                backgroundColor: 'rgba(142, 182, 155, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#235347',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                hoverPointRadius: 7,
                pointHoverBackgroundColor: '#051F20'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });

    // Animate stats on load
    document.addEventListener('DOMContentLoaded', function() {
        const statsCards = document.querySelectorAll('.card');
        statsCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.animation = 'fadeInUp 0.6s ease-out';
            }, index * 100);
        });
    });
</script>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-0">Dashboard</h2>
            <p class="text-muted small">Selamat datang kembali, {{ Auth::user()->nama }}! 👋</p>
        </div>
        <div>
            <span class="badge bg-success">
                <i class="fas fa-clock"></i> Terakhir login: {{ Auth::user()->updated_at->diffForHumans() }}
            </span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Total Pengaduan</p>
                            <h3 class="stat-value mb-0">128</h3>
                        </div>
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                    <small class="text-success"><i class="fas fa-arrow-up"></i> +12% dari bulan lalu</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Sedang Diproses</p>
                            <h3 class="stat-value mb-0">24</h3>
                        </div>
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-spinner"></i>
                        </div> 
                    </div>
                    <small class="text-info"><i class="fas fa-clock"></i> Rata-rata 2 hari</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Selesai</p>
                            <h3 class="stat-value mb-0">98</h3>
                        </div>
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <small class="text-muted">76.6% tingkat penyelesaian</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Total Siswa</p>
                            <h3 class="stat-value mb-0">342</h3>
                        </div>
                        <div class="stat-icon bg-info">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <small class="text-success"><i class="fas fa-arrow-up"></i> +5 siswa baru</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Bar Chart -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <h5 class="mb-0 card-title">
                        <i class="fas fa-chart-bar"></i> Pengaduan Per Bulan
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="barChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <h5 class="mb-0 card-title">
                        <i class="fas fa-chart-pie"></i> Status Pengaduan
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="row g-4 mb-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <h5 class="mb-0 card-title">
                        <i class="fas fa-chart-line"></i> Aktivitas Pengaduan Harian (7 Hari Terakhir)
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="lineChart" height="60"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints Table -->
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">
                        <i class="fas fa-list"></i> Pengaduan Terbaru
                    </h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="bg-light">
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
                                    <td><span class="badge bg-warning">Diproses</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>15 Apr 2026</small></td>
                                    <td>Siti Nur Azizah</td>
                                    <td>AC di Ruang Kelas Tidak Dingin</td>
                                    <td><span class="badge bg-warning">Diproses</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>14 Apr 2026</small></td>
                                    <td>Budi Santoso</td>
                                    <td>Lampu Putus di Koridor</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>13 Apr 2026</small></td>
                                    <td>Rina Wijaya</td>
                                    <td>Meja Sekolah Rusak</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small>12 Apr 2026</small></td>
                                    <td>Hendra Kusuma</td>
                                    <td>Kurangnya Tempat Parkir</td>
                                    <td><span class="badge bg-danger">Pending</span></td>
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
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Bar Chart - Pengaduan Per Bulan
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Total Pengaduan',
                data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 28, 25, 22],
                backgroundColor: '#0056b3',
                borderColor: '#004494',
                borderWidth: 1,
                borderRadius: 5,
                hoverBackgroundColor: '#004494',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10
                    }
                }
            }
        }
    });

    // Pie Chart - Status Pengaduan
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Diproses', 'Selesai'],
            datasets: [{
                data: [6, 24, 98],
                backgroundColor: [
                    '#dc3545',
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
                        padding: 15
                    }
                }
            }
        }
    });

    // Line Chart - Aktivitas Harian
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Pengaduan Baru',
                data: [12, 15, 10, 18, 22, 8, 5],
                borderColor: '#0056b3',
                backgroundColor: 'rgba(0, 86, 179, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#0056b3',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                hoverPointRadius: 7,
                pointHoverBackgroundColor: '#004494'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
 