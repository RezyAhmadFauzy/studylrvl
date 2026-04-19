<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: radial-gradient(circle at top left, rgba(13,110,253,.35), transparent 35%), radial-gradient(circle at bottom right, rgba(102,16,242,.3), transparent 30%), linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); color: #1e293b; font-family: 'Poppins', sans-serif; }
        .auth-card { max-width: 980px; margin: 3rem auto; border-radius: 28px; overflow: hidden; box-shadow: 0 35px 80px rgba(15, 23, 42, 0.2); }
        .auth-panel { min-height: 100%; background: linear-gradient(180deg, rgba(13,110,253,0.95) 0%, rgba(102,16,242,0.95) 100%); color: #fff; }
        .auth-panel h1 { font-size: 2.4rem; line-height: 1.1; }
        .auth-panel p { opacity: .85; }
        .auth-panel .badge { background: rgba(255,255,255,.18); backdrop-filter: blur(10px); }
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
                        <span class="badge rounded-pill px-4 py-2 mb-4">Login Siswa</span>
                        <h1 class="fw-bold mb-3">Akses Dashboard Siswa dengan mudah.</h1>
                        <p class="mb-4">Masuk untuk mengajukan pengaduan, melihat riwayat, dan memantau status tindak lanjut secara profesional.</p>
                        <div class="d-flex gap-3 mt-4">
                            <div>
                                <h2 class="h1 mb-0">342</h2>
                                <p class="mb-0">Siswa Terdaftar</p>
                            </div>
                            <div>
                                <h2 class="h1 mb-0">128</h2>
                                <p class="mb-0">Pengaduan Aktif</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-white-50">
                        <p class="mb-1">Sudah memiliki akun?</p>
                        <p class="fw-semibold mb-0">Gunakan username dan password Anda untuk mengakses dashboard siswa.</p>
                    </div>
                </div>
                <div class="col-lg-6 bg-white p-5">
                    <div class="mb-4 text-center">
                        <h3 class="fw-bold">Selamat Datang Kembali</h3>
                        <p class="text-muted mb-0">Masuk untuk melanjutkan. Jika belum punya akun, daftar terlebih dahulu sebagai siswa.</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger rounded-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.submit') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username" required>
                            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Masuk Sekarang</button>
                    </form>

                    <div class="auth-footer text-center mt-4">
                        <p class="mb-2">Belum punya akun? <a href="{{ route('register') }}" class="fw-semibold">Daftar siswa</a></p>
                        <p class="mb-0 text-muted">Jika Anda administrator, masuk melalui <a href="{{ route('admin.login') }}" class="fw-semibold">halaman login admin</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
