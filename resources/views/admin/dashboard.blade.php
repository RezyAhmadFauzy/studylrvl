@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="row g-0 align-items-center">
                <div class="col-lg-8 p-4 p-lg-5">
                    <h3 class="mb-2 fw-bold">Halo, {{ Auth::user()->nama ?? 'Admin' }}!</h3>
                    <p class="text-muted mb-4">Selamat datang di dashboard administrasi. Pantau semua pengaduan siswa dengan cepat dan ambil tindakan yang diperlukan.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.pengaduan.masuk') }}" class="btn btn-primary btn-sm">Lihat Pengaduan Masuk</a>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-secondary btn-sm">Kelola Siswa</a>
                        <a href="{{ route('admin.laporan') }}" class="btn btn-outline-primary btn-sm">Laporan</a>
                    </div>
                </div>
                <div class="col-lg-4 bg-primary bg-opacity-10 p-4 d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-4 bg-white shadow-sm p-3 mb-3" style="width: 72px; height: 72px;">
                            <i class="bi bi-speedometer2 fs-3 text-primary"></i>
                        </div>
                        <p class="mb-1 text-uppercase text-primary small fw-semibold">Dashboard</p>
                        <h4 class="mb-0">Ringkasan Sistem</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <small class="text-uppercase fw-semibold text-muted">Total Siswa</small>
                        <h3 class="mt-3 mb-0">342</h3>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-15 text-primary d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                </div>
                <div class="mt-3 text-success small"><i class="bi bi-arrow-up me-1"></i>12% dari bulan lalu</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <small class="text-uppercase fw-semibold text-muted">Total Pengaduan</small>
                        <h3 class="mt-3 mb-0">{{ $totalPengaduan }}</h3>
                    </div>
                    <div class="rounded-circle bg-secondary bg-opacity-15 text-secondary d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-journal-text fs-4"></i>
                    </div>
                </div>
                <div class="mt-3 text-info small"><i class="bi bi-arrow-up me-1"></i>8% dari bulan lalu</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <small class="text-uppercase fw-semibold text-muted">Pending</small>
                        <h3 class="mt-3 mb-0">{{ $pending }}</h3>
                    </div>
                    <div class="rounded-circle bg-danger bg-opacity-15 text-danger d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                </div>
                <div class="mt-3 text-danger small"><i class="bi bi-exclamation-circle me-1"></i>Butuh ditinjau</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <small class="text-uppercase fw-semibold text-muted">Selesai</small>
                        <h3 class="mt-3 mb-0">{{ $selesai }}</h3>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-15 text-success d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-check2-circle fs-4"></i>
                    </div>
                </div>
                <div class="mt-3 text-success small"><i class="bi bi-check2 me-1"></i>Selesai ditangani</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-xl-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1">Pengaduan Per Bulan</h5>
                    <small class="text-muted">Statistik 12 bulan terakhir</small>
                </div>
                <div>
                    <span class="badge bg-secondary">Live Update</span>
                </div>
            </div>
            <div class="card-body p-4">
                <canvas id="monthlyChart" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">Distribusi Status</h5>
            </div>
            <div class="card-body p-4">
                <canvas id="statusChart" height="260"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-xl-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">Aktivitas 7 Hari Terakhir</h5>
            </div>
            <div class="card-body p-4">
                <canvas id="activityChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0">Ringkasan Status</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Menunggu Ditinjau</span>
                        <span class="fw-semibold">{{ $pending }}</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($pending / $totalPengaduan * 100) : 0 }}%;"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Sedang Diproses</span>
                        <span class="fw-semibold">{{ $diproses }}</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($diproses / $totalPengaduan * 100) : 0 }}%;"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Selesai Ditangani</span>
                        <span class="fw-semibold">{{ $selesai }}</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($selesai / $totalPengaduan * 100) : 0 }}%;"></div>
                    </div>
                </div>
                <div class="mt-4 rounded-4 bg-primary bg-opacity-10 p-3">
                    <div class="small text-primary"><i class="bi bi-info-circle me-1"></i>Total Pengaduan</div>
                    <div class="fw-semibold">{{ $totalPengaduan }} laporan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1">Pengaduan Terbaru</h5>
                    <small class="text-muted">Lihat daftar laporan terbaru dari siswa.</small>
                </div>
                <a href="{{ route('admin.pengaduan.masuk') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Siswa</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentPengaduan as $pengaduan)
                            <tr>
                                <td class="fw-semibold">#{{ str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-primary bg-opacity-15 text-primary d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">{{ substr($pengaduan->user->nama ?? 'U', 0, 1) }}</div>
                                        <div>
                                            <div class="fw-semibold">{{ $pengaduan->user->nama }}</div>
                                            <div class="small text-muted">{{ $pengaduan->user->username }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Str::limit($pengaduan->judul, 40) }}</td>
                                <td>{{ $pengaduan->tanggal_lapor->format('d M Y') }}</td>
                                <td>
                                    @if ($pengaduan->status === 'pending')
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif ($pengaduan->status === 'diproses')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></a>
                                    <button onclick="updateStatus({{ $pengaduan->id }}, '{{ $pengaduan->status }}')" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1"></i>
                                    <div class="mt-2">Tidak ada pengaduan terbaru.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
