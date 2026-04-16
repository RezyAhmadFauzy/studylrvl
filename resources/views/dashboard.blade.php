@extends('layouts.app')

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
 