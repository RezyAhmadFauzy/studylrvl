@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-4">
                    <div>
                        <h2 class="h4 mb-2">Halo, {{ Auth::user()->nama ?? 'Admin' }}!</h2>
                        <p class="text-muted mb-0">Selamat datang di dashboard pengaduan siswa. Pantau statistik, status, dan laporan dari satu tampilan profesional.</p>
                    </div>
                    <div class="text-lg-end">
                        <span class="d-block text-muted small">Terakhir login</span>
                        <span class="fw-semibold">{{ Auth::user()->updated_at->format('d M Y, H:i') }}</span>
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
                    <div class="avatar rounded-circle bg-primary bg-opacity-15 text-primary d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
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
                    <div class="avatar rounded-circle bg-purple bg-opacity-15 text-purple d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bi bi-journal-text fs-4"></i>
                    </div>
                </div>
                <div class="mt-3 text-success small"><i class="bi bi-arrow-up me-1"></i>8% dari bulan lalu</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <small class="text-uppercase fw-semibold text-muted">Pengaduan Pending</small>
                        <h3 class="mt-3 mb-0">{{ $pending }}</h3>
                    </div>
                    <div class="avatar rounded-circle bg-danger bg-opacity-15 text-danger d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
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
                        <small class="text-uppercase fw-semibold text-muted">Pengaduan Selesai</small>
                        <h3 class="mt-3 mb-0">{{ $selesai }}</h3>
                    </div>
                    <div class="avatar rounded-circle bg-success bg-opacity-15 text-success d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
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
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($pending / $totalPengaduan * 100) : 0 }}%;" aria-valuenow="{{ $totalPengaduan > 0 ? ($pending / $totalPengaduan * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Sedang Diproses</span>
                        <span class="fw-semibold">{{ $diproses }}</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($diproses / $totalPengaduan * 100) : 0 }}%;" aria-valuenow="{{ $totalPengaduan > 0 ? ($diproses / $totalPengaduan * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Selesai Ditangani</span>
                        <span class="fw-semibold">{{ $selesai }}</span>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($selesai / $totalPengaduan * 100) : 0 }}%;" aria-valuenow="{{ $totalPengaduan > 0 ? ($selesai / $totalPengaduan * 100) : 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
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

<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="statusModalLabel">Update Status Pengaduan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="statusForm">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="status" id="statusPending" value="pending">
                        <label class="form-check-label" for="statusPending">Pending (Menunggu Ditinjau)</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="status" id="statusDiproses" value="diproses">
                        <label class="form-check-label" for="statusDiproses">Diproses (Sedang Ditangani)</label>
                    </div>
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="radio" name="status" id="statusSelesai" value="selesai">
                        <label class="form-check-label" for="statusSelesai">Selesai (Sudah Ditangani)</label>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pengaduan',
                data: [8, 12, 15, 9, 18, 14, 16, 11, 13, 10, 14, 16],
                backgroundColor: 'rgba(13, 110, 253, 0.8)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderRadius: 10,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#6c757d' }, grid: { color: '#e9ecef' } },
                x: { ticks: { color: '#6c757d' }, grid: { display: false } }
            }
        }
    });

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Diproses', 'Selesai'],
            datasets: [{
                data: [{{ $pending }}, {{ $diproses }}, {{ $selesai }}],
                backgroundColor: ['rgba(220, 53, 69, 0.8)', 'rgba(255, 193, 7, 0.8)', 'rgba(25, 135, 84, 0.8)'],
                borderColor: ['rgba(220, 53, 69, 1)', 'rgba(255, 193, 7, 1)', 'rgba(25, 135, 84, 1)'],
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { padding: 16, color: '#495057' } }
            }
        }
    });

    const activityCtx = document.getElementById('activityChart').getContext('2d');
    new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Pengaduan Baru',
                data: [12, 19, 8, 15, 10, 6, 4],
                borderColor: 'rgba(13, 110, 253, 1)',
                backgroundColor: 'rgba(13, 110, 253, 0.12)',
                borderWidth: 3,
                fill: true,
                tension: 0.35,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(13, 110, 253, 1)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#6c757d' }, grid: { color: '#e9ecef' } },
                x: { ticks: { color: '#6c757d' }, grid: { display: false } }
            }
        }
    });

    function updateStatus(pengaduanId, currentStatus) {
        const statusForm = document.getElementById('statusForm');
        const modal = new bootstrap.Modal(document.getElementById('statusModal'));
        statusForm.action = `/pengaduan/${pengaduanId}/status`;
        document.querySelectorAll('input[name="status"]').forEach((input) => {
            input.checked = input.value === currentStatus;
        });
        modal.show();
    }
</script>
@endpush
