@extends('layouts.student')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="student-dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <a href="{{ route('student.history') }}" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
            </a>
            <h2 class="page-title">Detail Pengaduan</h2>
        </div>
    </div>

    <div class="detail-container">
        <!-- Main Content -->
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Complaint Info -->
                <div class="card modern-card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-2">{{ $pengaduan->judul }}</h5>
                                <small class="text-muted">
                                    ID: #{{ str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT) }}
                                </small>
                            </div>
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="info-grid mb-4">
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="fas fa-calendar"></i> Tanggal Lapor
                                </span>
                                <p class="info-value">{{ $pengaduan->tanggal_lapor->format('d MMMM Y') }}</p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="fas fa-clock"></i> Waktu
                                </span>
                                <p class="info-value">{{ $pengaduan->tanggal_lapor->format('H:i') }} WIB</p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="fas fa-history"></i> Dibuat
                                </span>
                                <p class="info-value">{{ $pengaduan->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="info-item">
                                <span class="info-label">
                                    <i class="fas fa-sync"></i> Diperbarui
                                </span>
                                <p class="info-value">{{ $pengaduan->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <hr>

                        <!-- Description -->
                        <div class="description-section">
                            <h6 class="mb-3">
                                <i class="fas fa-align-left"></i> Deskripsi Pengaduan
                            </h6>
                            <p class="description-text">{{ $pengaduan->isi_laporan }}</p>
                        </div>

                        <!-- Photo -->
                        @if($pengaduan->foto)
                            <hr>
                            <div class="photo-section">
                                <h6 class="mb-3">
                                    <i class="fas fa-image"></i> Foto/Bukti
                                </h6>
                                <div class="photo-container">
                                    <img src="{{ asset('uploads/pengaduan/' . $pengaduan->foto) }}" 
                                         alt="Bukti pengaduan" 
                                         class="img-fluid">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="card modern-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-timeline"></i> Riwayat Status
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item active">
                                <div class="timeline-marker status-pending">
                                    <i class="fas fa-hourglass-start"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Pengaduan Dibuat</h6>
                                    <small>{{ $pengaduan->created_at->format('d M Y H:i') }}</small>
                                </div>
                            </div>

                            @if($pengaduan->status === 'diproses' || $pengaduan->status === 'selesai')
                                <div class="timeline-item active">
                                    <div class="timeline-marker status-process">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Pengaduan Diproses</h6>
                                        <small>{{ $pengaduan->updated_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                            @else
                                <div class="timeline-item">
                                    <div class="timeline-marker">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Pengaduan Diproses</h6>
                                        <small>Menunggu untuk diproses</small>
                                    </div>
                                </div>
                            @endif

                            @if($pengaduan->status === 'selesai')
                                <div class="timeline-item active">
                                    <div class="timeline-marker status-completed">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Pengaduan Selesai</h6>
                                        <small>{{ $pengaduan->updated_at->format('d M Y H:i') }}</small>
                                    </div>
                                </div>
                            @else
                                <div class="timeline-item">
                                    <div class="timeline-marker">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6>Pengaduan Selesai</h6>
                                        <small>Menunggu penyelesaian</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <!-- Status Card -->
                <div class="card modern-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Status Saat Ini</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="status-badge-large">
                            @if($pengaduan->status === 'pending')
                                <span class="badge-large bg-danger">
                                    <i class="fas fa-hourglass-start"></i>
                                </span>
                                <h5 class="mt-3">Pending</h5>
                                <p class="text-muted mb-0">Pengaduan menunggu untuk ditinjau oleh tim kami</p>
                            @elseif($pengaduan->status === 'diproses')
                                <span class="badge-large bg-warning">
                                    <i class="fas fa-spinner"></i>
                                </span>
                                <h5 class="mt-3">Diproses</h5>
                                <p class="text-muted mb-0">Tim kami sedang menangani pengaduan Anda</p>
                            @else
                                <span class="badge-large bg-success">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <h5 class="mt-3">Selesai</h5>
                                <p class="text-muted mb-0">Pengaduan Anda telah ditangani dan selesai</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submitter Info -->
                <div class="card modern-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">Informasi Pelapor</h5>
                    </div>
                    <div class="card-body">
                        <div class="submitter-info">
                            <div class="avatar mb-3">
                                <i class="fas fa-user"></i>
                            </div>
                            <h6>{{ $pengaduan->user->nama }}</h6>
                            <p class="text-muted mb-2">
                                <small>{{ ucfirst($pengaduan->user->role) }}</small>
                            </p>
                            <hr>
                            <p class="mb-0">
                                <i class="fas fa-user-check"></i> 
                                <small>Username: <strong>{{ $pengaduan->user->username }}</strong></small>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Cards -->
                <div class="card modern-card">
                    <div class="card-header">
                        <h5 class="card-title">Aksi</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('student.create') }}" class="btn btn-primary btn-block mb-2">
                            <i class="fas fa-plus-circle"></i> Buat Pengaduan Baru
                        </a>
                        <a href="{{ route('student.history') }}" class="btn btn-outline-secondary btn-block">
                            <i class="fas fa-list"></i> Lihat Semua Pengaduan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .timeline {
        position: relative;
    }

    .timeline-item {
        display: flex;
        margin-bottom: 30px;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 25px;
        top: 60px;
        width: 2px;
        height: calc(100% + 20px);
        background: #e0e0e0;
    }

    .timeline-item.active::before {
        background: #28a745;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-marker {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #f0f0f0;
        border: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
        font-size: 20px;
        color: #999;
    }

    .timeline-item.active .timeline-marker {
        border-color: currentColor;
    }

    .timeline-marker.status-pending {
        background: #ffe5e5;
        border-color: #dc3545;
        color: #dc3545;
    }

    .timeline-marker.status-process {
        background: #fff4e5;
        border-color: #ffc107;
        color: #ffc107;
    }

    .timeline-marker.status-completed {
        background: #e5f9e5;
        border-color: #28a745;
        color: #28a745;
    }
</style>
@endpush
@endsection
