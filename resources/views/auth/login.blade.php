<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TANGSEL DIGITAL ACADEMIC - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 60px 45px;
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
        .login-header {
            text-align: center;
            margin-bottom: 45px;
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

        .brand-name {
            font-size: 26px;
            font-weight: 800;
            color: #0a47a8;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #0a47a8 0%, #1565d8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-tagline {
            font-size: 13px;
            color: #999;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .login-title {
            font-size: 18px;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-size: 13px;
            color: #999;
            line-height: 1.6;
        }

        /* Alert Messages */
        .alert-container {
            margin-bottom: 25px;
        }

        .alert {
            background: linear-gradient(135deg, #fee8e8 0%, #fed7d7 100%);
            border-left: 4px solid #fc5a5a;
            padding: 14px 16px;
            border-radius: 8px;
            color: #721c24;
            font-size: 13px;
            line-height: 1.6;
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

        .alert p {
            margin: 0;
            font-weight: 500;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #333;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid #e8e8e8;
            border-radius: 12px;
            font-size: 14px;
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

        .form-group.error .form-input {
            border-color: #fc5a5a;
            background: #fff9f9;
        }

        .form-group.error .form-input:focus {
            box-shadow: 0 0 0 4px rgba(252, 90, 90, 0.1);
        }

        .error-text {
            color: #fc5a5a;
            font-size: 12px;
            margin-top: 7px;
            font-weight: 500;
            display: none;
        }

        .form-group.error .error-text {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 42px;
            color: #bbb;
            font-size: 18px;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .form-input:focus ~ .input-icon {
            color: #1565d8;
        }

        /* Remember & Forgot */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 13px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-wrapper input {
            cursor: pointer;
            accent-color: #1565d8;
        }

        .checkbox-wrapper label {
            color: #666;
            cursor: pointer;
            font-weight: 500;
        }

        .forgot-link {
            color: #1565d8;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #0a47a8;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 14px 20px;
            background: linear-gradient(135deg, #0a47a8 0%, #1565d8 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 20px rgba(10, 71, 168, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
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

        .login-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(10, 71, 168, 0.4);
        }

        .login-btn:active {
            transform: translateY(-1px);
        }

        .login-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-text {
            position: relative;
            z-index: 1;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #f0f0f0;
            font-size: 13px;
            color: #999;
            line-height: 1.8;
        }

        .login-footer strong {
            color: #1565d8;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .login-card {
                padding: 45px 30px;
                border-radius: 20px;
            }

            .brand-name {
                font-size: 22px;
            }

            .login-btn {
                padding: 13px 18px;
                font-size: 14px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .blob-top,
            .blob-bottom {
                opacity: 0.5;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 40px 22px;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .brand-name {
                font-size: 20px;
            }

            .login-header {
                margin-bottom: 35px;
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

    <!-- Login Container -->
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="brand-logo">🎓</div>
                <div class="brand-name">TANGSEL DIGITAL ACADEMIC</div>
                <div class="brand-tagline">Pendidikan Digital Terpadu</div>
                <div class="login-title">Masuk ke Akun Anda</div>
                <p class="login-subtitle">Masukkan kredensial untuk melanjutkan ke dashboard</p>
            </div>

            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="alert-container">
                    <div class="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Username Field -->
                <div class="form-group @error('username') error @enderror">
                    <label class="form-label" for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-input"
                        placeholder="Masukkan username Anda"
                        value="{{ old('username') }}"
                        required
                        autocomplete="username"
                    >
                    <span class="input-icon">👤</span>
                    @error('username')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group @error('password') error @enderror">
                    <label class="form-label" for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input"
                        placeholder="Masukkan password Anda"
                        required
                        autocomplete="current-password"
                    >
                    <span class="input-icon">🔒</span>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Form Options -->
                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="login-btn">
                    <span class="btn-text">Masuk Sekarang</span>
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                Demo Login:<br>
                <strong>User:</strong> user / user123<br>
                <strong>Admin:</strong> admin / password123
            </div>
        </div>
    </div>
</body>
</html>

