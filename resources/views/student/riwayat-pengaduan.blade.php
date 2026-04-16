@extends('layouts.student')

@section('title', 'Riwayat Pengaduan')

@section('content')
<div class="student-dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h2 class="page-title">Riwayat Pengaduan</h2>
            <p class="page-subtitle">Kelola dan pantau semua pengaduan Anda</p>
        </div>
        <div>
            <a href="{{ route('student.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Buat Pengaduan Baru
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="filter-container mb-4">
        <div class="card modern-card">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Filter Status</label>
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" @if(request('status') === 'pending') selected @endif>Pending</option>
                            <option value="diproses" @if(request('status') === 'diproses') selected @endif>Diproses</option>
                            <option value="selesai" @if(request('status') === 'selesai') selected @endif>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutkan</label>
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="terbaru" @if(request('sort') === 'terbaru') selected @endif>Terbaru</option>
                            <option value="terlama" @if(request('sort') === 'terlama') selected @endif>Terlama</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari judul pengaduan..." value="{{ request('search') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Complaints List -->
    <div class="complaints-container">
        @if($pengaduan->count() > 0)
            @foreach($pengaduan as $item)
                <div class="card modern-card complaint-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="complaint-header">
                                    <h5 class="complaint-title">
                                        <i class="fas fa-exclamation-circle"></i> {{ $item->judul }}
                                    </h5>
                                    <div class="complaint-meta">
                                        <span class="meta-item">
                                            <i class="fas fa-calendar"></i> {{ $item->tanggal_lapor->format('d M Y H:i') }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-id-card"></i> ID: #{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                </div>
                                <p class="complaint-description">
                                    {{ Str::limit($item->isi_laporan, 200) }}
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="status-section">
                                    @if($item->status === 'pending')
                                        <span class="badge badge-lg bg-danger">
                                            <i class="fas fa-hourglass-start"></i> Pending
                                        </span>
                                        <small class="status-note">Menunggu untuk ditinjau</small>
                                    @elseif($item->status === 'diproses')
                                        <span class="badge badge-lg bg-warning">
                                            <i class="fas fa-spinner"></i> Diproses
                                        </span>
                                        <small class="status-note">Tim sedang menangani</small>
                                    @else
                                        <span class="badge badge-lg bg-success">
                                            <i class="fas fa-check-circle"></i> Selesai
                                        </span>
                                        <small class="status-note">Telah ditangani</small>
                                    @endif
                                </div>
                                <div class="action-buttons mt-3">
                                    <a href="{{ route('student.show', $item) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            @if($pengaduan->hasPages())
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        @if($pengaduan->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">← Sebelumnya</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $pengaduan->previousPageUrl() }}">← Sebelumnya</a>
                            </li>
                        @endif

                        @foreach($pengaduan->getUrlRange(1, $pengaduan->lastPage()) as $page => $url)
                            @if($page == $pengaduan->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if($pengaduan->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $pengaduan->nextPageUrl() }}">Selanjutnya →</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Selanjutnya →</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        @else
            <!-- Empty State -->
            <div class="card modern-card">
                <div class="card-body">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h4>Tidak Ada Pengaduan</h4>
                        <p>Anda belum membuat pengaduan apapun. Mulai dengan membuat pengaduan baru.</p>
                        <a href="{{ route('student.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle"></i> Buat Pengaduan Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Add animations
    document.querySelectorAll('.complaint-card').forEach((card, index) => {
        card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.1}s backwards`;
    });
</script>
@endpush
@endsection
