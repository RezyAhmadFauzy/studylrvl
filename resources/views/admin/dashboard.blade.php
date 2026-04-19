@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    :root {
        --dark-green: #051F20;
        --deep-green: #0B2B26;
        --dark-soft-green: #163832;
        --primary-green: #235347;
        --soft-green: #8EB69B;
        --light-green: #DAF1DE;
        --accent-green: #1d6d5c;
    }

    .admin-dashboard {
        background: linear-gradient(135deg, rgba(5, 31, 32, 0.02), rgba(11, 43, 38, 0.02));
    }

    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        color: white;
        border-radius: 20px;
        padding: 3rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(35, 83, 71, 0.2);
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(142, 182, 155, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-banner .content {
        position: relative;
        z-index: 1;
    }

    .welcome-banner h2 {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .welcome-banner p {
        font-size: 1rem;
        opacity: 0.95;
        margin-bottom: 1.5rem;
    }

    .banner-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .banner-buttons .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .banner-buttons .btn-light {
        background: white;
        color: var(--primary-green);
    }

    .banner-buttons .btn-light:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .banner-buttons .btn-outline-light {
        border-color: white;
        color: white;
        background: transparent;
    }

    .banner-buttons .btn-outline-light:hover {
        background: white;
        color: var(--primary-green);
    }

    /* Stats Cards */
    .stats-card-modern {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-left: 5px solid var(--primary-green);
        transition: all 0.3s ease;
    }

    .stats-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
    }

    .stats-card-modern.pending {
        border-left-color: #ef4444;
    }

    .stats-card-modern.processing {
        border-left-color: #f59e0b;
    }

    .stats-card-modern.completed {
        border-left-color: #10b981;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-green);
        margin: 0.5rem 0;
    }

    .stat-label {
        color: #64748b;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .stat-change {
        font-size: 0.85rem;
        margin-top: 0.5rem;
        color: #10b981;
    }

    /* Data Table */
    .table-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .table-card-header {
        padding: 2rem;
        border-bottom: 1px solid #e2e8f0;
        background: linear-gradient(135deg, rgba(35, 83, 71, 0.05) 0%, rgba(142, 182, 155, 0.05) 100%);
    }

    .table-card-header h5 {
        color: var(--primary-green);
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .table-card-header p {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #f8fafc;
        border-top: none;
        border-bottom: 2px solid #e2e8f0;
        color: var(--dark-green);
        font-weight: 700;
        padding: 1rem 1.5rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #f9fafb;
    }

    .student-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--soft-green), var(--light-green));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        margin-right: 0.75rem;
    }

    .student-info h6 {
        font-weight: 700;
        color: var(--dark-green);
        margin-bottom: 0.25rem;
    }

    .student-info p {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-badge.pending {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-badge.processing {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge.completed {
        background: #d1fae5;
        color: #065f46;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-buttons .btn-sm {
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .action-buttons .btn-view {
        background: #dbeafe;
        color: #1e40af;
    }

    .action-buttons .btn-view:hover {
        background: #bfdbfe;
    }

    .action-buttons .btn-edit {
        background: #ddd6fe;
        color: #5b21b6;
    }

    .action-buttons .btn-edit:hover {
        background: #c4b5fd;
    }

    .action-buttons .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .action-buttons .btn-delete:hover {
        background: #fecaca;
    }

    /* Modals */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        color: white;
        border: none;
        border-radius: 16px 16px 0 0;
        padding: 1.5rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 0 0 16px 16px;
    }

    .form-group label {
        font-weight: 600;
        color: var(--dark-green);
        margin-bottom: 0.75rem;
    }

    .form-control, .form-select {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(35, 83, 71, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-green), var(--accent-green));
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(35, 83, 71, 0.3);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-state-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--light-green), rgba(142, 182, 155, 0.3));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 1.5rem;
        color: var(--primary-green);
    }

    .empty-state h5 {
        color: var(--dark-green);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 1.5rem;
    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stats-card-modern {
        animation: slideIn 0.5s ease-out;
    }

    .stats-card-modern:nth-child(2) {
        animation-delay: 0.1s;
    }

    .stats-card-modern:nth-child(3) {
        animation-delay: 0.2s;
    }

    .stats-card-modern:nth-child(4) {
        animation-delay: 0.3s;
    }

    .table-card {
        animation: slideIn 0.5s ease-out 0.4s backwards;
    }
</style>

<div class="admin-dashboard">
    <!-- Welcome Banner -->
    <div class="welcome-banner mb-4">
        <div class="content">
            <h2><i class="fas fa-wave-hand me-2"></i>Selamat Datang, {{ Auth::user()->nama ?? 'Admin' }}!</h2>
            <p>Kelola pengaduan siswa dan pantau progress resolusi dengan mudah</p>
            <div class="banner-buttons">
                <a href="{{ route('admin.pengaduan.masuk') }}" class="btn btn-light">
                    <i class="fas fa-inbox me-2"></i>Lihat Pengaduan Masuk
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline-light">
                    <i class="fas fa-users me-2"></i>Kelola Siswa
                </a>
                <a href="{{ route('admin.laporan') }}" class="btn btn-outline-light">
                    <i class="fas fa-file-pdf me-2"></i>Buat Laporan
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="stats-card-modern pending">
                <div class="stat-icon" style="background: #fee2e2; color: #ef4444;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-label">Pengaduan Pending</div>
                <div class="stat-value">{{ $pending ?? 0 }}</div>
                <div class="stat-change">
                    <i class="fas fa-exclamation-circle me-1"></i>Perlu ditinjau
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stats-card-modern processing">
                <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
                    <i class="fas fa-spinner"></i>
                </div>
                <div class="stat-label">Sedang Diproses</div>
                <div class="stat-value">{{ $diproses ?? 0 }}</div>
                <div class="stat-change">
                    <i class="fas fa-cog me-1"></i>Dalam pengerjaan
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stats-card-modern completed">
                <div class="stat-icon" style="background: #d1fae5; color: #10b981;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-label">Pengaduan Selesai</div>
                <div class="stat-value">{{ $selesai ?? 0 }}</div>
                <div class="stat-change">
                    <i class="fas fa-arrow-up me-1"></i>{{ $totalPengaduan > 0 ? round(($selesai / $totalPengaduan * 100), 1) : 0 }}%
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stats-card-modern">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--light-green), rgba(142, 182, 155, 0.3)); color: var(--primary-green);">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-label">Total Pengaduan</div>
                <div class="stat-value">{{ $totalPengaduan ?? 0 }}</div>
                <div class="stat-change">
                    <i class="fas fa-database me-1"></i>Semua kategori
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Summary -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="stats-card-modern">
                <h5 class="mb-3">
                    <i class="fas fa-tasks me-2" style="color: var(--primary-green);"></i>Ringkasan Progress
                </h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($pending / $totalPengaduan * 100) : 0 }}%; background: #ef4444;"></div>
                        </div>
                        <small class="text-muted">Pending: {{ $pending ?? 0 }} ({{ $totalPengaduan > 0 ? round(($pending / $totalPengaduan * 100), 1) : 0 }}%)</small>
                    </div>
                    <div class="col-md-4">
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($diproses / $totalPengaduan * 100) : 0 }}%; background: #f59e0b;"></div>
                        </div>
                        <small class="text-muted">Diproses: {{ $diproses ?? 0 }} ({{ $totalPengaduan > 0 ? round(($diproses / $totalPengaduan * 100), 1) : 0 }}%)</small>
                    </div>
                    <div class="col-md-4">
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $totalPengaduan > 0 ? ($selesai / $totalPengaduan * 100) : 0 }}%; background: #10b981;"></div>
                        </div>
                        <small class="text-muted">Selesai: {{ $selesai ?? 0 }} ({{ $totalPengaduan > 0 ? round(($selesai / $totalPengaduan * 100), 1) : 0 }}%)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints Table -->
    <div class="row g-4">
        <div class="col-12">
            <div class="table-card">
                <div class="table-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Pengaduan Terbaru</h5>
                        <p class="mb-0">Kelola dan proses pengaduan terbaru dari siswa</p>
                    </div>
                    <a href="{{ route('admin.pengaduan.masuk') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-right me-2"></i>Lihat Semua
                    </a>
                </div>

                @if($recentPengaduan && count($recentPengaduan) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Siswa</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPengaduan as $pengaduan)
                                    <tr>
                                        <td>
                                            <code style="color: var(--primary-green); font-weight: 700;">#{{ str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT) }}</code>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="student-avatar">
                                                    {{ isset($pengaduan->user) && isset($pengaduan->user->nama) ? substr($pengaduan->user->nama, 0, 1) : 'U' }}
                                                </div>
                                                <div class="student-info">
                                                    <h6>{{ isset($pengaduan->user) && isset($pengaduan->user->nama) ? $pengaduan->user->nama : 'Nama tidak tersedia' }}</h6>
                                                    <p>{{ isset($pengaduan->user) && isset($pengaduan->user->nis) ? $pengaduan->user->nis : '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ Str::limit($pengaduan->judul ?? 'Judul tidak tersedia', 40) }}</strong>
                                                <div style="color: #64748b; font-size: 0.85rem;">
                                                    {{ Str::limit($pengaduan->isi_laporan ?? '', 50) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $pengaduan->tanggal_lapor ? $pengaduan->tanggal_lapor->format('d M Y') : 'N/A' }}</strong>
                                                <div style="color: #64748b; font-size: 0.85rem;">
                                                    {{ $pengaduan->tanggal_lapor ? $pengaduan->tanggal_lapor->format('H:i') : '' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($pengaduan->status === 'pending')
                                                <span class="status-badge pending">
                                                    <i class="fas fa-hourglass-start"></i> Pending
                                                </span>
                                            @elseif($pengaduan->status === 'diproses')
                                                <span class="status-badge processing">
                                                    <i class="fas fa-spinner"></i> Diproses
                                                </span>
                                            @else
                                                <span class="status-badge completed">
                                                    <i class="fas fa-check-circle"></i> Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons justify-content-center">
                                                <button class="btn-view" title="Lihat Detail" onclick="viewComplaint({{ $pengaduan->id }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn-edit" title="Update Status" onclick="editStatus({{ $pengaduan->id }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-delete" title="Hapus" onclick="deleteComplaint({{ $pengaduan->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h5>Tidak Ada Pengaduan</h5>
                        <p>Semua pengaduan sudah ditangani dengan baik</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- View Detail Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-file-alt me-2"></i>Detail Pengaduan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="text-center">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-sync-alt me-2"></i>Update Status Pengaduan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    @csrf
                    <input type="hidden" id="pengaduanId">
                    
                    <div class="form-group mb-3">
                        <label for="newStatus" class="form-label">Status Baru</label>
                        <select id="newStatus" class="form-select" required>
                            <option value="">Pilih Status</option>
                            <option value="pending">Pending</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="form-group mb-0">
                        <label for="catatan" class="form-label">Catatan (Opsional)</label>
                        <textarea id="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan untuk pengaduan ini..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitStatusUpdate()">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.2/dist/apexcharts.min.js"></script>

<script>
    // Get CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // View Complaint Details
    function viewComplaint(id) {
        const modal = new bootstrap.Modal(document.getElementById('viewModal'));
        const modalBody = document.getElementById('viewModalBody');
        
        // Show loading
        modalBody.innerHTML = '<div class="text-center"><div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        modal.show();

        // Fetch complaint data
        fetch(`/api/pengaduan/${id}`)
            .then(response => response.json())
            .then(data => {
                const pengaduan = data.pengaduan;
                const statusClass = pengaduan.status === 'pending' ? 'pending' : (pengaduan.status === 'diproses' ? 'processing' : 'completed');
                const statusLabel = pengaduan.status === 'pending' ? 'Pending' : (pengaduan.status === 'diproses' ? 'Diproses' : 'Selesai');
                
                let photoHtml = '';
                if (pengaduan.foto) {
                    photoHtml = `<div class="mt-3"><strong>Foto/Bukti:</strong><br><img src="/uploads/pengaduan/${pengaduan.foto}" class="img-fluid mt-2" style="max-height: 300px; border-radius: 8px;"></div>`;
                }

                modalBody.innerHTML = `
                    <div class="detail-content">
                        <div class="mb-3">
                            <h6 class="text-muted mb-1">ID Pengaduan</h6>
                            <code style="color: var(--primary-green); font-weight: 700; font-size: 1.1rem;">#${String(pengaduan.id).padStart(5, '0')}</code>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6 class="text-muted mb-1">Judul</h6>
                            <h5>${pengaduan.judul}</h5>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted mb-1">Deskripsi</h6>
                            <p>${pengaduan.isi_laporan}</p>
                        </div>

                        ${photoHtml}

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Pelapor</h6>
                                <p class="mb-1"><strong>${pengaduan.user.nama}</strong></p>
                                <p class="mb-1" style="color: #64748b; font-size: 0.9rem;">
                                    <i class="fas fa-id-card me-1"></i>${pengaduan.user.nis || 'N/A'}
                                </p>
                                <p style="color: #64748b; font-size: 0.9rem;">
                                    <i class="fas fa-envelope me-1"></i>${pengaduan.user.email}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Status</h6>
                                <span class="status-badge ${statusClass}">
                                    <i class="fas fa-${pengaduan.status === 'pending' ? 'hourglass-start' : (pengaduan.status === 'diproses' ? 'spinner' : 'check-circle')}"></i> ${statusLabel}
                                </span>
                            </div>
                        </div>

                        <hr>

                        <div>
                            <h6 class="text-muted mb-1">Tanggal Lapor</h6>
                            <p>${new Date(pengaduan.tanggal_lapor).toLocaleString('id-ID', { 
                                year: 'numeric', 
                                month: 'long', 
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            })}</p>
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error:', error);
                modalBody.innerHTML = '<div class="alert alert-danger">Gagal memuat data pengaduan</div>';
            });
    }

    // Edit Status
    function editStatus(id) {
        document.getElementById('pengaduanId').value = id;
        document.getElementById('newStatus').value = '';
        document.getElementById('catatan').value = '';
        new bootstrap.Modal(document.getElementById('editModal')).show();
    }

    // Submit Status Update
    function submitStatusUpdate() {
        const pengaduanId = document.getElementById('pengaduanId').value;
        const status = document.getElementById('newStatus').value;
        const catatan = document.getElementById('catatan').value;

        if (!status) {
            alert('Pilih status terlebih dahulu');
            return;
        }

        const formData = new FormData();
        formData.append('_method', 'POST');
        formData.append('status', status);
        formData.append('catatan', catatan);

        fetch(`/admin/pengaduan/${pengaduanId}/status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status: status,
                catatan: catatan
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                showAlert('Status pengaduan berhasil diperbarui!', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showAlert('Gagal memperbarui status', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan', 'danger');
        });
    }

    // Delete Complaint
    function deleteComplaint(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus pengaduan ini? Tindakan ini tidak dapat dibatalkan.')) {
            return;
        }

        fetch(`/admin/pengaduan/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Pengaduan berhasil dihapus!', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showAlert('Gagal menghapus pengaduan', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan', 'danger');
        });
    }

    // Show Alert
    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Insert alert at top of page
        const firstElement = document.querySelector('.admin-dashboard');
        if (firstElement) {
            firstElement.insertAdjacentHTML('beforebegin', alertHtml);
        }
    }
</script>
@endpush

@endsection
