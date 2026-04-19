<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Pengaduan Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a47a8 0%, #1565d8 50%, #0d5ac3 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative Elements */
        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .blob-top {
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 45% 55% 60% 40% / 55% 45% 40% 60%;
            top: -100px;
            right: -100px;
            animation: float 8s infinite ease-in-out;
        }

        .blob-bottom {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 60% 40% 55% 45% / 40% 60% 45% 55%;
            bottom: -100px;
            left: -100px;
            animation: float 10s infinite ease-in-out reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0px, 0px); }
            33% { transform: translate(30px, -30px); }
            66% { transform: translate(-20px, 20px); }
        }

        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 600px;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 45px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3),
                        0 0 1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: slideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Section */
        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0a47a8 0%, #1565d8 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            box-shadow: 0 10px 30px rgba(10, 71, 168, 0.3);
            animation: bounceIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }

        .register-title {
            font-size: 24px;
            font-weight: 800;
            color: #0a47a8;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #0a47a8 0%, #1565d8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .register-subtitle {
            font-size: 13px;
            color: #999;
            line-height: 1.6;
        }

        /* Alert Messages */
        .alert {
            margin-bottom: 20px;
            border-radius: 8px;
            border: none;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #333;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #e8e8e8;
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fafafa;
            color: #333;
        }

        .form-input::placeholder {
            color: #bbb;
        }

        .form-input:focus {
            outline: none;
            border-color: #1565d8;
            background: white;
            box-shadow: 0 0 0 4px rgba(21, 101, 216, 0.1),
                        inset 0 0 0 1px rgba(21, 101, 216, 0.2);
        }

        .form-input:hover {
            border-color: #d0d0d0;
        }

        .form-input.is-invalid {
            border-color: #fc5a5a;
            background: #fff9f9;
        }

        .form-input.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(252, 90, 90, 0.1);
        }

        .form-input.is-valid {
            border-color: #28a745;
            background: #f9fff9;
        }

        .invalid-feedback,
        .valid-feedback {
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .invalid-feedback {
            color: #fc5a5a;
        }

        .valid-feedback {
            color: #28a745;
        }

        /* Password Strength Meter */
        .password-strength {
            margin-top: 8px;
        }

        .strength-meter {
            height: 6px;
            background: #f0f0f0;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .strength-meter-fill {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .strength-meter-fill.weak {
            width: 33%;
            background: #fc5a5a;
        }

        .strength-meter-fill.fair {
            width: 66%;
            background: #ffc107;
        }

        .strength-meter-fill.strong {
            width: 100%;
            background: #28a745;
        }

        .strength-text {
            font-size: 11px;
            font-weight: 600;
        }

        .strength-text.weak {
            color: #fc5a5a;
        }

        .strength-text.fair {
            color: #ffc107;
        }

        .strength-text.strong {
            color: #28a745;
        }

        /* Form Row for Two Columns */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Register Button */
        .register-btn {
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, #0a47a8 0%, #1565d8 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 20px rgba(10, 71, 168, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .register-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .register-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(10, 71, 168, 0.4);
        }

        .register-btn:active {
            transform: translateY(-1px);
        }

        .register-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Footer */
        .register-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
            font-size: 13px;
            color: #999;
        }

        .register-footer a {
            color: #1565d8;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-footer a:hover {
            color: #0a47a8;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .register-card {
                padding: 35px 25px;
                border-radius: 20px;
            }

            .register-title {
                font-size: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .blob-top,
            .blob-bottom {
                opacity: 0.5;
            }
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 30px 18px;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .register-title {
                font-size: 18px;
            }

            .register-header {
                margin-bottom: 25px;
            }

            .form-group {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Background Decorations -->
    <div class="bg-decoration">
        <div class="blob-top"></div>
        <div class="blob-bottom"></div>
    </div>

    <!-- Register Container -->
    <div class="register-wrapper">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <div class="brand-logo">👨‍🎓</div>
                <h1 class="register-title">Daftar Akun Siswa</h1>
                <p class="register-subtitle">Isi data diri Anda untuk membuat akun baru</p>
            </div>

            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi Kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" id="registerForm" novalidate>
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        class="form-input @error('nama') is-invalid @endif"
                        placeholder="Contoh: Ahmad Surya"
                        value="{{ old('nama') }}"
                        required
                    >
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIS dan Kelas -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nis">NIS</label>
                        <input 
                            type="text" 
                            id="nis" 
                            name="nis" 
                            class="form-input @error('nis') is-invalid @endif"
                            placeholder="Nomor Induk Siswa"
                            value="{{ old('nis') }}"
                            required
                        >
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kelas">Kelas</label>
                        <select 
                            id="kelas" 
                            name="kelas" 
                            class="form-input @error('kelas') is-invalid @endif"
                            required
                        >
                            <option value="">Pilih Kelas</option>
                            <option value="10">Kelas 10</option>
                            <option value="11">Kelas 11</option>
                            <option value="12">Kelas 12</option>
                        </select>
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-input @error('username') is-invalid @endif"
                        placeholder="Username unik Anda"
                        value="{{ old('username') }}"
                        required
                    >
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input @error('email') is-invalid @endif"
                        placeholder="email@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') is-invalid @endif"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                    <div class="password-strength">
                        <div class="strength-meter">
                            <div class="strength-meter-fill"></div>
                        </div>
                        <span class="strength-text">-</span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input @error('password_confirmation') is-invalid @endif"
                        placeholder="Ketik ulang password"
                        required
                    >
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Terms & Conditions -->
                <div class="form-group">
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            id="agree" 
                            name="agree"
                            required
                        >
                        <label class="form-check-label" for="agree">
                            Saya setuju dengan <a href="#" style="color: #1565d8; text-decoration: none;">syarat & ketentuan</a>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="register-btn">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </button>
            </form>

            <!-- Footer -->
            <div class="register-footer">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password Strength Meter
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.querySelector('.strength-meter-fill');
        const strengthText = document.querySelector('.strength-text');

        function checkPasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;

            const levels = ['', 'weak', 'fair', 'strong'];
            const texts = ['-', 'Lemah', 'Cukup', 'Kuat'];
            const currentLevel = levels[Math.min(strength, 3)];
            
            strengthMeter.className = `strength-meter-fill ${currentLevel}`;
            strengthText.className = `strength-text ${currentLevel}`;
            strengthText.textContent = texts[Math.min(strength, 3)];
        }

        passwordInput?.addEventListener('input', (e) => {
            checkPasswordStrength(e.target.value);
        });

        // Form Validation
        const form = document.getElementById('registerForm');
        form?.addEventListener('submit', function(e) {
            if (!form.checkValidity() === false) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    </script>
</body>
</html>
