<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siswa - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: radial-gradient(circle at top left, rgba(13,110,253,.3), transparent 35%), radial-gradient(circle at bottom right, rgba(102,16,242,.25), transparent 30%), linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); color: #1e293b; font-family: 'Poppins', sans-serif; }
        .auth-card { max-width: 980px; margin: 3rem auto; border-radius: 28px; overflow: hidden; box-shadow: 0 35px 80px rgba(15, 23, 42, 0.2); }
        .auth-panel { min-height: 100%; background: linear-gradient(180deg, rgba(13,110,253,0.95), rgba(102,16,242,0.95)); color: #fff; }
        .auth-panel h1 { font-size: 2.4rem; line-height: 1.1; }
        .form-control { min-height: 50px; border-radius: 14px; }
        .form-control:focus { border-color: #4f46e5; box-shadow: 0 0 0 0.2rem rgba(99,102,241,.18); }
        .btn-primary { border-radius: 14px; min-height: 50px; font-weight: 600; }
        .auth-footer { font-size: .95rem; }
        .auth-footer a { color: #0d6efd; text-decoration: none; }
        .auth-footer a:hover { text-decoration: underline; }
        @media (max-width: 991px) {
            .auth-panel { display: none; }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card auth-card shadow-lg">
            <div class="row g-0">
                <div class="col-lg-6 auth-panel p-5 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge rounded-pill px-4 py-2 mb-4">Register Siswa</span>
                        <h1 class="fw-bold mb-3">Gabung sekarang dan buat pengaduan dengan cepat.</h1>
                        <p class="mb-4">Isi data diri Anda untuk mengakses dashboard siswa dan memantau proses pengaduan dengan mudah.</p>
                        <div class="d-flex gap-4 mt-4">
                            <div>
                                <h2 class="h1 mb-0">100+</h2>
                                <p class="mb-0">Pengaduan Selesai</p>
                            </div>
                            <div>
                                <h2 class="h1 mb-0">500+</h2>
                                <p class="mb-0">Siswa Terdaftar</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-white-50">
                        <p class="mb-1">Sudah punya akun?</p>
                        <p class="fw-semibold mb-0">Kembali ke halaman login siswa untuk masuk ke dashboard.</p>
                    </div>
                </div>
                <div class="col-lg-6 bg-white p-5">
                    <div class="mb-4 text-center">
                        <h3 class="fw-bold">Buat Akun Baru</h3>
                        <p class="text-muted mb-0">Lengkapi formulir berikut untuk mendaftar sebagai siswa.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger rounded-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.submit') }}" method="POST" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama lengkap" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">NIS</label>
                                <input type="text" name="nis" value="{{ old('nis') }}" class="form-control @error('nis') is-invalid @enderror" placeholder="NIS" required>
                                @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kelas</label>
                                <select name="kelas" class="form-select @error('kelas') is-invalid @enderror" required>
                                    <option value="">Pilih kelas</option>
                                    <option value="10" {{ old('kelas') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="11" {{ old('kelas') == '11' ? 'selected' : '' }}>11</option>
                                    <option value="12" {{ old('kelas') == '12' ? 'selected' : '' }}>12</option>
                                </select>
                                @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input @error('agree') is-invalid @enderror" type="checkbox" name="agree" id="agree" {{ old('agree') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="agree">Saya menyetujui syarat dan ketentuan.</label>
                                    @error('agree')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                            </div>
                        </div>
                    </form>

                    <div class="auth-footer text-center mt-4">
                        <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold">Login siswa</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
