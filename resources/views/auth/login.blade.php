<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TANGSEL DIGITAL ACADEMIC - Login & Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            overflow-x: hidden;
        }

        /* ============================================
           BACKGROUND DECORATIONS & ANIMATIONS
           ============================================ */

        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .blob {
            position: absolute;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 45% 55% 60% 40% / 55% 45% 40% 60%;
            animation: float 8s infinite ease-in-out;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
        }

        .blob-2 {
            width: 300px;
            height: 300px;
            bottom: -100px;
            left: -100px;
            background: rgba(255, 255, 255, 0.03);
            animation-duration: 10s;
            animation-direction: reverse;
        }

        .blob-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            right: 10%;
            background: rgba(255, 255, 255, 0.02);
            animation-duration: 12s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0px, 0px) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        .floating-particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float-particle 20s infinite;
        }

        @keyframes float-particle {
            0% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0;
            }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% {
                transform: translateY(-100vh) translateX(100px) scale(0);
                opacity: 0;
            }
        }

        /* ============================================
           AUTH CONTAINER & CARD
           ============================================ */

        .auth-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 540px;
            perspective: 1000px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 60px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3),
                        0 0 1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: slideUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            min-height: 620px;
            position: relative;
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

        .auth-container {
            position: relative;
            min-height: 450px;
        }

        /* ============================================
           HEADER SECTION
           ============================================ */

        .auth-header {
            text-align: center;
            margin-bottom: 35px;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
            0% { transform: scale(0.3) rotateX(90deg); opacity: 0; }
            50% { transform: scale(1.05); }
            100% { transform: scale(1) rotateX(0deg); opacity: 1; }
        }

        .brand-name {
            font-size: 26px;
            font-weight: 800;
            color: #0a47a8;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #0a47a8 0%, #1565d8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-tagline {
            font-size: 12px;
            color: #999;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .auth-title {
            font-size: 20px;
            color: #333;
            font-weight: 700;
            margin-bottom: 8px;
            transition: all 0.4s ease;
        }

        .auth-subtitle {
            font-size: 13px;
            color: #999;
            line-height: 1.6;
        }

        /* ============================================
           FORM TOGGLE TABS
           ============================================ */

        .form-tabs {
            display: flex;
            gap: 0;
            margin-bottom: 30px;
            background: #f5f5f5;
            padding: 4px;
            border-radius: 12px;
            animation: slideDown 0.6s ease 0.2s both;
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

        .form-tab {
            flex: 1;
            padding: 12px 20px;
            background: transparent;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #999;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-tab.active {
            background: white;
            color: #1565d8;
            box-shadow: 0 4px 12px rgba(21, 101, 216, 0.15);
        }

        .form-tab:hover:not(.active) {
            color: #666;
        }

        /* ============================================
           FORMS
           ============================================ */

        .form-wrapper {
            position: relative;
            overflow: hidden;
        }

        .auth-form {
            opacity: 0;
            transform: translateX(40px);
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
            position: absolute;
            width: 100%;
        }

        .auth-form.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
            position: relative;
        }

        .auth-form.exit-left {
            transform: translateX(-40px);
        }

        /* ============================================
           FORM ELEMENTS
           ============================================ */

        .form-group {
            margin-bottom: 20px;
            position: relative;
            animation: slideUp 0.6s ease both;
        }

        .auth-form.active .form-group {
            animation: slideUp 0.6s ease both;
        }

        .auth-form.active .form-group:nth-child(1) { animation-delay: 0.1s; }
        .auth-form.active .form-group:nth-child(2) { animation-delay: 0.2s; }
        .auth-form.active .form-group:nth-child(3) { animation-delay: 0.3s; }
        .auth-form.active .form-group:nth-child(4) { animation-delay: 0.4s; }
        .auth-form.active .form-group:nth-child(5) { animation-delay: 0.5s; }
        .auth-form.active .form-group:nth-child(6) { animation-delay: 0.6s; }
        .auth-form.active .form-group:nth-child(7) { animation-delay: 0.7s; }

        .form-label {
            display: block;
            color: #333;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid #e8e8e8;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fafafa;
            color: #333;
        }

        .form-input::placeholder {
            color: #bbb;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #1565d8;
            background: white;
            box-shadow: 0 0 0 4px rgba(21, 101, 216, 0.1),
                        inset 0 0 0 1px rgba(21, 101, 216, 0.2);
            transform: translateY(-2px);
        }

        .form-input:hover,
        .form-select:hover {
            border-color: #d0d0d0;
        }

        .form-group.error .form-input,
        .form-group.error .form-select {
            border-color: #fc5a5a;
            background: #fff9f9;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-group.error .form-input:focus,
        .form-group.error .form-select:focus {
            box-shadow: 0 0 0 4px rgba(252, 90, 90, 0.1);
        }

        .error-text {
            color: #fc5a5a;
            font-size: 11px;
            margin-top: 6px;
            font-weight: 600;
            display: none;
            animation: slideDown 0.3s ease;
        }

        .form-group.error .error-text {
            display: block;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 38px;
            color: #bbb;
            font-size: 18px;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .form-input:focus ~ .input-icon {
            color: #1565d8;
            transform: scale(1.2);
        }

        /* ============================================
           FORM ROW (2 COLUMNS)
           ============================================ */

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        /* ============================================
           PASSWORD STRENGTH METER
           ============================================ */

        .password-strength {
            margin-top: 8px;
            animation: slideDown 0.3s ease;
        }

        .strength-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 2px;
        }

        .strength-fill.strength-0 { width: 0%; background: #999; }
        .strength-fill.strength-1 { width: 20%; background: #fc5a5a; }
        .strength-fill.strength-2 { width: 40%; background: #ffc107; }
        .strength-fill.strength-3 { width: 60%; background: #20c997; }
        .strength-fill.strength-4 { width: 80%; background: #28a745; }
        .strength-fill.strength-5 { width: 100%; background: #28a745; }

        .strength-text {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #999;
            transition: color 0.3s ease;
        }

        .strength-text.strength-0 { color: #999; }
        .strength-text.strength-1 { color: #fc5a5a; }
        .strength-text.strength-2 { color: #ffc107; }
        .strength-text.strength-3 { color: #20c997; }
        .strength-text.strength-4 { color: #28a745; }
        .strength-text.strength-5 { color: #28a745; }

        /* ============================================
           FORM OPTIONS
           ============================================ */

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
            animation: slideUp 0.6s ease 0.3s both;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-wrapper input {
            cursor: pointer;
            accent-color: #1565d8;
            width: 16px;
            height: 16px;
            transition: all 0.3s ease;
        }

        .checkbox-wrapper input:hover {
            transform: scale(1.2);
        }

        .checkbox-wrapper label {
            color: #666;
            cursor: pointer;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .checkbox-wrapper label:hover {
            color: #1565d8;
        }

        .forgot-link {
            color: #1565d8;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .forgot-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #1565d8;
            transition: width 0.3s ease;
        }

        .forgot-link:hover::after {
            width: 100%;
        }

        .forgot-link:hover {
            color: #0a47a8;
        }

        /* ============================================
           BUTTONS
           ============================================ */

        .auth-btn {
            width: 100%;
            padding: 14px 20px;
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
            animation: slideUp 0.6s ease 0.4s both;
        }

        .auth-btn::before {
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

        .auth-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .auth-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(10, 71, 168, 0.4);
        }

        .auth-btn:active {
            transform: translateY(-1px);
        }

        .auth-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-text {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* ============================================
           FOOTER
           ============================================ */

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
            font-size: 13px;
            color: #999;
            line-height: 1.8;
            animation: slideUp 0.6s ease 0.5s both;
        }

        .auth-footer strong {
            color: #1565d8;
            font-weight: 600;
        }

        .auth-footer a {
            color: #1565d8;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .auth-footer a:hover {
            color: #0a47a8;
        }

        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 4px solid #28a745;
            padding: 14px 16px;
            border-radius: 8px;
            color: #155724;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 25px;
            animation: slideDown 0.4s ease-out;
        }

        .error-message {
            background: linear-gradient(135deg, #fee8e8 0%, #fed7d7 100%);
            border-left: 4px solid #fc5a5a;
            padding: 14px 16px;
            border-radius: 8px;
            color: #721c24;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 25px;
            animation: slideDown 0.4s ease-out;
        }

        /* ============================================
           RESPONSIVE DESIGN
           ============================================ */

        @media (max-width: 600px) {
            .auth-card {
                padding: 40px 25px;
                min-height: auto;
            }

            .brand-name {
                font-size: 22px;
            }

            .auth-title {
                font-size: 18px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .form-options {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .blob {
                opacity: 0.5 !important;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 35px 18px;
                border-radius: 20px;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .brand-name {
                font-size: 20px;
            }

            .auth-header {
                margin-bottom: 25px;
            }

            .form-tabs {
                margin-bottom: 25px;
            }

            .form-tab {
                padding: 10px 15px;
                font-size: 12px;
            }

            .auth-btn {
                padding: 12px 16px;
                font-size: 13px;
            }
        }

        /* ============================================
           TOOLTIP
           ============================================ */

        .tooltip-text {
            font-size: 11px;
            color: #999;
            margin-top: 4px;
            display: block;
        }

        /* ============================================
           LOADING SPINNER
           ============================================ */

        .spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Background Decorations -->
    <div class="bg-decoration">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- Floating Particles -->
    <script>
        // Buat floating particles
        for (let i = 0; i < 15; i++) {
            const particle = document.createElement('div');
            particle.className = 'floating-particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 20 + 's';
            particle.style.animationDuration = (15 + Math.random() * 10) + 's';
            document.querySelector('.bg-decoration').appendChild(particle);
        }
    </script>

    <!-- Auth Container -->
    <div class="auth-wrapper">
        <div class="auth-card">
            <!-- Header -->
            <div class="auth-header">
                <div class="brand-logo">🎓</div>
                <div class="brand-name">TANGSEL DIGITAL ACADEMIC</div>
                <div class="brand-tagline">Sistem Pengaduan Siswa</div>
                <div class="auth-title" id="authTitle">Masuk ke Akun Anda</div>
                <p class="auth-subtitle" id="authSubtitle">Masukkan kredensial untuk melanjutkan</p>
            </div>

            <!-- Form Tabs -->
            <div class="form-tabs">
                <button class="form-tab active" data-form="login" onclick="switchForm('login')">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
                <button class="form-tab" data-form="register" onclick="switchForm('register')">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </div>

            <!-- Forms Container -->
            <div class="form-wrapper">
                <!-- LOGIN FORM -->
                <form id="loginForm" class="auth-form active" action="{{ route('login') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="error-message">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group @error('username') error @enderror">
                        <label class="form-label" for="login-username">Username</label>
                        <input 
                            type="text" 
                            id="login-username" 
                            name="username" 
                            class="form-input"
                            placeholder="Masukkan username"
                            value="{{ old('username') }}"
                            required
                            autocomplete="username"
                        >
                        <span class="input-icon">👤</span>
                        @error('username')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('password') error @enderror">
                        <label class="form-label" for="login-password">Password</label>
                        <input 
                            type="password" 
                            id="login-password" 
                            name="password" 
                            class="form-input"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                        >
                        <span class="input-icon">🔒</span>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <label for="remember">Ingat saya</label>
                        </div>
                        <a href="#" class="forgot-link">Lupa password?</a>
                    </div>

                    <button type="submit" class="auth-btn">
                        <span class="btn-text">
                            <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
                        </span>
                    </button>
                </form>

                <!-- REGISTER FORM -->
                <form id="registerForm" class="auth-form" action="{{ route('register') }}" method="POST">
                    @csrf

                    @if (session('success'))
                        <div class="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group @error('nama') error @enderror">
                        <label class="form-label" for="reg-nama">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="reg-nama" 
                            name="nama" 
                            class="form-input"
                            placeholder="Contoh: Ahmad Surya"
                            value="{{ old('nama') }}"
                            required
                        >
                        <span class="input-icon">👤</span>
                        @error('nama')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group @error('nis') error @enderror">
                            <label class="form-label" for="reg-nis">NIS</label>
                            <input 
                                type="text" 
                                id="reg-nis" 
                                name="nis" 
                                class="form-input"
                                placeholder="Nomor Induk Siswa"
                                value="{{ old('nis') }}"
                                required
                            >
                            <span class="input-icon">🆔</span>
                            @error('nis')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group @error('kelas') error @enderror">
                            <label class="form-label" for="reg-kelas">Kelas</label>
                            <select 
                                id="reg-kelas" 
                                name="kelas" 
                                class="form-select"
                                required
                            >
                                <option value="">Pilih Kelas</option>
                                <option value="10">Kelas 10</option>
                                <option value="11">Kelas 11</option>
                                <option value="12">Kelas 12</option>
                            </select>
                            <span class="input-icon">📚</span>
                            @error('kelas')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group @error('username') error @enderror">
                        <label class="form-label" for="reg-username">Username</label>
                        <input 
                            type="text" 
                            id="reg-username" 
                            name="username" 
                            class="form-input"
                            placeholder="Username unik (min 4 karakter)"
                            value="{{ old('username') }}"
                            required
                        >
                        <span class="input-icon">👤</span>
                        <span class="tooltip-text">Gunakan huruf, angka, underscore, atau dash</span>
                        @error('username')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('email') error @enderror">
                        <label class="form-label" for="reg-email">Email</label>
                        <input 
                            type="email" 
                            id="reg-email" 
                            name="email" 
                            class="form-input"
                            placeholder="email@example.com"
                            value="{{ old('email') }}"
                            required
                        >
                        <span class="input-icon">✉️</span>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('password') error @enderror">
                        <label class="form-label" for="reg-password">Password</label>
                        <input 
                            type="password" 
                            id="reg-password" 
                            name="password" 
                            class="form-input"
                            placeholder="Minimal 8 karakter"
                            required
                            onchange="checkPasswordStrength()"
                            oninput="checkPasswordStrength()"
                        >
                        <span class="input-icon">🔒</span>
                        <div class="password-strength" style="display: none;">
                            <div class="strength-bar">
                                <div class="strength-fill strength-0" id="passwordStrength"></div>
                            </div>
                            <span class="strength-text strength-0" id="strengthText">-</span>
                        </div>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('password_confirmation') error @enderror">
                        <label class="form-label" for="reg-password-confirm">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            id="reg-password-confirm" 
                            name="password_confirmation" 
                            class="form-input"
                            placeholder="Ketik ulang password"
                            required
                        >
                        <span class="input-icon">🔐</span>
                        @error('password_confirmation')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('agree') error @enderror">
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <input 
                                type="checkbox" 
                                id="agree" 
                                name="agree" 
                                value="1"
                                required
                                style="width: 16px; height: 16px; margin-top: 4px; cursor: pointer; accent-color: #1565d8;"
                            >
                            <label for="agree" style="color: #666; font-size: 13px; cursor: pointer; line-height: 1.6;">
                                Saya setuju dengan syarat & ketentuan penggunaan sistem pengaduan siswa
                            </label>
                        </div>
                        @error('agree')
                            <span class="error-text" style="display: block; margin-top: 6px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="auth-btn">
                        <span class="btn-text">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </span>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="auth-footer">
                Demo Login: <strong>user / user123</strong>
            </div>
        </div>
    </div>

    <script>
        // ============================================
        // FORM SWITCHING LOGIC
        // ============================================

        function switchForm(formType) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginTab = document.querySelector('[data-form="login"]');
            const registerTab = document.querySelector('[data-form="register"]');
            const authTitle = document.getElementById('authTitle');
            const authSubtitle = document.getElementById('authSubtitle');

            if (formType === 'login') {
                // Switch to login form
                loginForm.classList.remove('exit-left');
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
                registerForm.classList.add('exit-left');

                loginTab.classList.add('active');
                registerTab.classList.remove('active');

                authTitle.textContent = 'Masuk ke Akun Anda';
                authSubtitle.textContent = 'Masukkan kredensial untuk melanjutkan ke dashboard';
            } else {
                // Switch to register form
                loginForm.classList.remove('active');
                loginForm.classList.add('exit-left');
                registerForm.classList.remove('exit-left');
                registerForm.classList.add('active');

                loginTab.classList.remove('active');
                registerTab.classList.add('active');

                authTitle.textContent = 'Buat Akun Baru';
                authSubtitle.textContent = 'Daftar untuk mulai membuat pengaduan';
            }
        }

        // ============================================
        // PASSWORD STRENGTH METER
        // ============================================

        function checkPasswordStrength() {
            const password = document.getElementById('reg-password').value;
            const strength = calculatePasswordStrength(password);
            const strengthFill = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('strengthText');
            const strengthBar = document.querySelector('.password-strength');

            // Show/hide strength bar
            if (password.length > 0) {
                strengthBar.style.display = 'block';
            } else {
                strengthBar.style.display = 'none';
            }

            // Update strength level
            strengthFill.className = 'strength-fill strength-' + strength.level;
            strengthText.className = 'strength-text strength-' + strength.level;
            strengthText.textContent = strength.text;
        }

        function calculatePasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;

            const levels = [
                { level: 0, text: '-' },
                { level: 1, text: 'Lemah' },
                { level: 2, text: 'Sedang' },
                { level: 3, text: 'Kuat' },
                { level: 4, text: 'Sangat Kuat' },
                { level: 5, text: 'Sangat Kuat' }
            ];

            return levels[Math.min(strength, 5)];
        }

        // ============================================
        // FORM VALIDATION
        // ============================================

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            validateLoginForm(e);
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            validateRegisterForm(e);
        });

        function validateLoginForm(e) {
            const username = document.getElementById('login-username').value.trim();
            const password = document.getElementById('login-password').value.trim();

            if (!username || !password) {
                e.preventDefault();
                showFieldError(username ? 'login-password' : 'login-username');
            }
        }

        function validateRegisterForm(e) {
            const nama = document.getElementById('reg-nama').value.trim();
            const nis = document.getElementById('reg-nis').value.trim();
            const kelas = document.getElementById('reg-kelas').value;
            const username = document.getElementById('reg-username').value.trim();
            const email = document.getElementById('reg-email').value.trim();
            const password = document.getElementById('reg-password').value;
            const passwordConfirm = document.getElementById('reg-password-confirm').value;

            let isValid = true;

            if (!nama) { showFieldError('reg-nama'); isValid = false; }
            if (!nis) { showFieldError('reg-nis'); isValid = false; }
            if (!kelas) { showFieldError('reg-kelas'); isValid = false; }
            if (!username) { showFieldError('reg-username'); isValid = false; }
            if (!email || !isValidEmail(email)) { showFieldError('reg-email'); isValid = false; }
            if (password.length < 8) { showFieldError('reg-password'); isValid = false; }
            if (password !== passwordConfirm) { showFieldError('reg-password-confirm'); isValid = false; }

            if (!isValid) e.preventDefault();
        }

        function showFieldError(fieldId) {
            const field = document.getElementById(fieldId);
            const group = field.closest('.form-group');
            
            if (!group.classList.contains('error')) {
                group.classList.add('error');
                field.focus();
                
                // Remove error after 3 seconds or on input
                setTimeout(() => {
                    field.addEventListener('input', function removeError() {
                        group.classList.remove('error');
                        field.removeEventListener('input', removeError);
                    }, { once: true });
                }, 3000);
            }
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        // ============================================
        // REAL-TIME INPUT VALIDATION
        // ============================================

        document.querySelectorAll('.form-input, .form-select').forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.form-group').classList.remove('error');
            });
        });

        // ============================================
        // FLOATING PARTICLES ANIMATION
        // ============================================

        document.addEventListener('DOMContentLoaded', function() {
            // Add more interactive animations
            document.body.addEventListener('mousemove', function(e) {
                const blobs = document.querySelectorAll('.blob');
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;

                blobs.forEach((blob, index) => {
                    const offset = (index + 1) * 20;
                    blob.style.transform = `translate(${x * offset}px, ${y * offset}px)`;
                });
            });
        });
    </script>
</body>
</html>

