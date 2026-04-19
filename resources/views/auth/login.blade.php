<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-green: #051F20;
            --deep-green: #0B2B26;
            --dark-soft-green: #163832;
            --primary-green: #235347;
            --soft-green: #8EB69B;
            --light-green: #DAF1DE;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--dark-green), var(--deep-green), var(--dark-soft-green), var(--primary-green));
            background-attachment: fixed;
            color: #fff;
            overflow-x: hidden;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(142, 182, 155, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(218, 241, 222, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 32px;
            padding: 3rem 2.5rem;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(5, 31, 32, 0.3),
                        0 0 0 1px rgba(255, 255, 255, 0.05);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--soft-green), var(--light-green));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 30px rgba(142, 182, 155, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .login-header .logo i {
            font-size: 2.5rem;
            color: var(--dark-green);
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--light-green), var(--soft-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            color: var(--light-green);
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: var(--soft-green);
            box-shadow: 0 0 0 3px rgba(142, 182, 155, 0.2);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--light-green);
            background: rgba(255, 255, 255, 0.1);
        }

        .form-check {
            margin-bottom: 1.5rem;
        }

        .form-check-input {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            width: 18px;
            height: 18px;
            margin-right: 0.75rem;
            transition: all 0.2s ease;
        }

        .form-check-input:checked {
            background-color: var(--soft-green);
            border-color: var(--soft-green);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(142, 182, 155, 0.2);
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary-green), var(--soft-green));
            border: none;
            border-radius: 16px;
            color: var(--dark-green);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(35, 83, 71, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(35, 83, 71, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-footer p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .login-footer a {
            color: var(--light-green);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .login-footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .alert {
            border-radius: 16px;
            border: none;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #ff6b7d;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .alert-success {
            background: rgba(25, 135, 84, 0.1);
            color: #7dd3a8;
            border: 1px solid rgba(25, 135, 84, 0.2);
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
                border-radius: 24px;
            }

            .login-header h1 {
                font-size: 1.75rem;
            }

            .login-header .logo {
                width: 70px;
                height: 70px;
            }

            .login-header .logo i {
                font-size: 2rem;
            }
        }

        /* Floating particles animation */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(142, 182, 155, 0.3);
            border-radius: 50%;
            pointer-events: none;
            animation: float 6s infinite linear;
        }

        .particle:nth-child(1) { animation-delay: 0s; }
        .particle:nth-child(2) { animation-delay: 1s; }
        .particle:nth-child(3) { animation-delay: 2s; }
        .particle:nth-child(4) { animation-delay: 3s; }
        .particle:nth-child(5) { animation-delay: 4s; }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Floating particles -->
    <div class="particle" style="left: 10%; animation-duration: 8s;"></div>
    <div class="particle" style="left: 20%; animation-duration: 10s;"></div>
    <div class="particle" style="left: 70%; animation-duration: 7s;"></div>
    <div class="particle" style="left: 80%; animation-duration: 9s;"></div>
    <div class="particle" style="left: 90%; animation-duration: 11s;"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1>Selamat Datang</h1>
                <p>Masuk ke akun siswa Anda untuk melanjutkan</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                           class="form-control @error('username') is-invalid @enderror"
                           placeholder="Masukkan username Anda" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Masukkan password Anda" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                </button>
            </form>

            <div class="login-footer">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Siswa</a></p>
                <p><a href="#" class="text-muted">Lupa Password?</a></p>
                <p class="mt-3">
                    <small class="text-muted">Jika Anda administrator, <a href="{{ route('admin.login') }}">login di sini</a></small>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Add smooth animations on focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Form validation enhancement
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('.btn-login');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Masuk...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>
