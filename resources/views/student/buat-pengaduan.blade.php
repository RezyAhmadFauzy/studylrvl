@extends('layouts.student')

@section('title', 'Buat Pengaduan')

@section('content')
<div class="student-dashboard">
    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h2 class="page-title">Buat Pengaduan Baru</h2>
            <p class="page-subtitle">Sampaikan pengaduan Anda dengan detail</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-container">
        <div class="card modern-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-pen-fancy"></i> Form Pengaduan Lengkap
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" id="pengaduanForm">
                    @csrf

                    <!-- Judul -->
                    <div class="form-group mb-4">
                        <label for="judul" class="form-label">
                            <i class="fas fa-heading"></i> Judul Pengaduan <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                               id="judul" 
                               name="judul" 
                               placeholder="Contoh: AC di Kelas A Rusak"
                               value="{{ old('judul') }}"
                               required>
                        <small class="form-text text-muted">Buat judul yang singkat dan deskriptif</small>
                        @error('judul')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Isi Laporan -->
                    <div class="form-group mb-4">
                        <label for="isi_laporan" class="form-label">
                            <i class="fas fa-align-left"></i> Deskripsi Laporan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-lg @error('isi_laporan') is-invalid @enderror" 
                                  id="isi_laporan" 
                                  name="isi_laporan" 
                                  rows="6" 
                                  placeholder="Jelaskan secara rinci mengenai pengaduan Anda. Sertakan:
- Apa yang terjadi
- Kapan terjadi
- Di mana lokasinya
- Dampak yang Anda alami"
                                  required>{{ old('isi_laporan') }}</textarea>
                        <small class="form-text text-muted">
                            Minimal 10 karakter | <span id="charCount">0</span>/500 karakter
                        </small>
                        @error('isi_laporan')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Foto -->
                    <div class="form-group mb-4">
                        <label for="foto" class="form-label">
                            <i class="fas fa-image"></i> Foto/Bukti (Opsional)
                        </label>
                        <div class="file-upload-area" id="fileUploadArea">
                            <input type="file" 
                                   class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" 
                                   name="foto" 
                                   accept="image/*"
                                   style="display: none;">
                            <div class="upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Drag & drop gambar di sini atau <a href="#" id="browseBtn">pilih file</a></p>
                                <small>Format: JPG, PNG, GIF | Ukuran maksimal: 2MB</small>
                            </div>
                            <div id="previewContainer" class="preview-container" style="display: none;">
                                <img id="previewImage" src="" alt="Preview">
                                <button type="button" class="btn-remove-file" id="removeFileBtn">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @error('foto')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="info-box mb-4">
                        <h6><i class="fas fa-info-circle"></i> Informasi Penting</h6>
                        <ul>
                            <li>Pengaduan Anda akan ditinjau dalam waktu 1-2 hari kerja</li>
                            <li>Anda dapat melacak status pengaduan melalui dashboard</li>
                            <li>Pastikan informasi yang Anda berikan akurat dan jelas</li>
                            <li>Jangan cantumkan informasi pribadi yang sensitif</li>
                        </ul>
                    </div>

                    <!-- Buttons -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                        </button>
                        <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Textarea character counter
    const textarea = document.getElementById('isi_laporan');
    const charCount = document.getElementById('charCount');
    
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });

    // File upload handling
    const fileInput = document.getElementById('foto');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const browseBtn = document.getElementById('browseBtn');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const removeFileBtn = document.getElementById('removeFileBtn');

    browseBtn.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.click();
    });

    fileInput.addEventListener('change', function(e) {
        handleFile(this.files[0]);
    });

    fileUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#0056b3';
        this.style.backgroundColor = '#f0f7ff';
    });

    fileUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#ddd';
        this.style.backgroundColor = '#fff';
    });

    fileUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#ddd';
        this.style.backgroundColor = '#fff';
        handleFile(e.dataTransfer.files[0]);
    });

    function handleFile(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                fileUploadArea.querySelector('.upload-content').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }

    removeFileBtn.addEventListener('click', function() {
        fileInput.value = '';
        previewContainer.style.display = 'none';
        fileUploadArea.querySelector('.upload-content').style.display = 'block';
    });

    // Form submission
    document.getElementById('pengaduanForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    });
</script>
@endpush
@endsection
