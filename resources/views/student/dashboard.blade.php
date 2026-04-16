@extends('layouts.student')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="student-dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h2 class="page-title">Dashboard Saya</h2>
            <p class="page-subtitle">Pantau status pengaduan Anda di sini</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card total-card">
            <div class="card-content">
                <div class="stat-icon">
                    <i class="fas fa-list-check"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Total Pengaduan</p>
                    <h3 class="stat-value">{{ $totalPengaduan }}</h3>
                </div>
            </div>
            <div class="card-footer">
                <small>Semua pengaduan yang telah dibuat</small>
            </div>
        </div>

        <div class="stat-card pending-card">
            <div class="card-content">
                <div class="stat-icon">
                    <i class="fas fa-hourglass-start"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Pending</p>
                    <h3 class="stat-value">{{ $pending }}</h3>
                </div>
            </div>
            <div class="card-footer">
                <small>Menunggu ditinjau</small>
            </div>
        </div>

        <div class="stat-card process-card">
            <div class="card-content">
                <div class="stat-icon">
                    <i class="fas fa-spinner"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Diproses</p>
                    <h3 class="stat-value">{{ $diproses }}</h3>
                </div>
            </div>
            <div class="card-footer">
                <small>Sedang ditangani</small>
            </div>
        </div>

        <div class="stat-card completed-card">
            <div class="card-content">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <p class="stat-label">Selesai</p>
                    <h3 class="stat-value">{{ $selesai }}</h3>
                </div>
            </div>
            <div class="card-footer">
                <small>Sudah ditangani</small>
            </div>
        </div>
    </div>

    <!-- Chart and Quick Form Section -->
    <div class="dashboard-content">
        <!-- Chart -->
        <div class="chart-container">
            <div class="card modern-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-chart-pie"></i> Status Pengaduan Anda
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Form -->
        <div class="quick-form-container">
            <div class="card modern-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-pen-fancy"></i> Buat Pengaduan Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" id="quickPengaduanForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="judul" class="form-label">Judul Pengaduan</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" placeholder="Contoh: AC Rusak di Kelas A"
                                   value="{{ old('judul') }}" required>
                            @error('judul')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="isi_laporan" class="form-label">Deskripsi Laporan</label>
                            <textarea class="form-control @error('isi_laporan') is-invalid @enderror" 
                                      id="isi_laporan" name="isi_laporan" rows="3" 
                                      placeholder="Jelaskan secara detail mengenai pengaduan Anda..."
                                      required>{{ old('isi_laporan') }}</textarea>
                            @error('isi_laporan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto" class="form-label">Foto/Bukti (Opsional)</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Maksimal 2MB, format: JPG, PNG, GIF</small>
                            @error('foto')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                        </button>
                        <a href="{{ route('student.create') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-right"></i> Form Lengkap
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints -->
    <div class="recent-complaints">
        <div class="card modern-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock"></i> Pengaduan Terbaru
                </h5>
                <a href="{{ route('student.history') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentPengaduan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="table-header">
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPengaduan as $pengaduan)
                                    <tr>
                                        <td>
                                            <small>{{ $pengaduan->tanggal_lapor->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ Str::limit($pengaduan->judul, 50) }}</strong>
                                        </td>
                                        <td>
                                            @if($pengaduan->status === 'pending')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-hourglass-start"></i> Pending
                                                </span>
                                            @elseif($pengaduan->status === 'diproses')
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-spinner"></i> Diproses
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('student.show', $pengaduan) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada pengaduan</p>
                        <a href="{{ route('student.create') }}" class="btn btn-primary btn-sm">
                            Buat Pengaduan Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Status Chart
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diproses', 'Selesai'],
                datasets: [{
                    data: [{{ $statusData['pending'] }}, {{ $statusData['diproses'] }}, {{ $statusData['selesai'] }}],
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
                            padding: 15,
                            font: {
                                family: "'Poppins', sans-serif"
                            }
                        }
                    }
                }
            }
        });
    }

    // Form submission animation
    document.getElementById('quickPengaduanForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('.btn-submit');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    });
</script>
@endpush
@endsection
