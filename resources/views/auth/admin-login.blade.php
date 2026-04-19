<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: radial-gradient(circle at top left, rgba(13,110,253,.35), transparent 35%), radial-gradient(circle at bottom right, rgba(15,23,42,.15), transparent 35%), linear-gradient(135deg, #1e293b 0%, #111827 100%); color: #f8fafc; font-family: 'Poppins', sans-serif; }
        .auth-card { max-width: 520px; margin: 3rem auto; border-radius: 28px; overflow: hidden; box-shadow: 0 35px 80px rgba(15, 23, 42, 0.4); }
        .auth-panel { min-height: 100%; background: radial-gradient(circle at top left, rgba(96,165,250,.18), transparent 30%), linear-gradient(180deg, #0f172a 0%, #111827 100%); color: #fff; }
        .auth-panel h1 { font-size: 2.4rem; line-height: 1.1; }
        .form-control { min-height: 50px; border-radius: 14px; background: rgba(255,255,255,.95); }
        .form-control:focus { border-color: #3b82f6; box-shadow: 0 0 0 0.2rem rgba(59,130,246,.18); }
        .btn-dark { border-radius: 14px; min-height: 50px; font-weight: 600; }
        .auth-footer a { color: #93c5fd; }
        @media (max-width: 991px) { .auth-panel { display: none; } }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card auth-card shadow-lg">
            <div class="row g-0">
                <div class="col-lg-6 auth-panel p-5 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge bg-white text-dark rounded-pill px-4 py-2 mb-4">Area Admin</span>
                        <h1 class="fw-bold mb-3">Dashboard Admin</h1>
                        <p class="mb-4">Masuk untuk memantau laporan, mengelola data siswa, dan mengawasi seluruh proses pengaduan.</p>
                        <div class="d-flex gap-4 mt-4">
                            <div>
                                <h2 class="h1 mb-0">Admin</h2>
                                <p class="mb-0">Akses khusus</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-white-50 mt-4">
                        <p class="mb-1">Hanya untuk role admin.</p>
                        <p class="mb-0">Jika Anda siswa, kembali ke <a href="{{ route('login') }}" class="text-white fw-semibold">halaman login siswa</a>.</p>
                    </div>
                </div>
                <div class="col-lg-6 bg-white p-5">
                    <div class="mb-4 text-center">
                        <h3 class="fw-bold">Login Admin</h3>
                        <p class="text-muted mb-0">Masukkan credential admin untuk lanjut ke dashboard.</p>
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

                    <form action="{{ route('admin.login.submit') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username Admin</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="Username admin" required>
                            @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Masuk Admin</button>
                    </form>

                    <div class="auth-footer text-center mt-4">
                        <p class="mb-0 text-muted">Kembali ke <a href="{{ route('login') }}" class="fw-semibold">Login Siswa</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
