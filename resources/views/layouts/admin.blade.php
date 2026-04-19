<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.2/dist/apexcharts.min.js"></script>
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
        }

        [data-theme="dark"] {
            --dark-bg: #0f172a;
            --light-bg: #1e293b;
            --card-bg: #334155;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --border-color: #475569;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .top-navbar {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            height: 70px;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .search-box {
            position: relative;
            max-width: 400px;
            width: 100%;
        }

        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid var(--border-color);
            border-radius: 50px;
            background: var(--card-bg);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            position: fixed;
            top: 70px;
            left: 0;
            bottom: 0;
            z-index: 1040;
            transition: all 0.3s ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 2px;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar.hide {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 2rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .sidebar-logo i {
            font-size: 1.8rem;
            color: white;
        }

        .sidebar-title {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .sidebar-subtitle {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            padding: 0 1.5rem 0.5rem;
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            border-radius: 0 25px 25px 0;
            margin: 0 0.5rem 0.125rem 0;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: white;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: white;
            border-radius: 0 2px 2px 0;
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .sidebar .nav-link .badge {
            margin-left: auto;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .logout-btn {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Stats Cards */
        .stats-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), transparent);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stats-change {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .stats-change.positive {
            color: var(--success-color);
        }

        .stats-change.negative {
            color: var(--danger-color);
        }

        /* Charts */
        .chart-container {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            height: 400px;
        }

        /* Tables */
        .data-table {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
        }

        .data-table thead th {
            background: var(--light-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .data-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table tbody tr:hover {
            background: var(--light-bg);
        }

        /* Buttons */
        .btn-modern {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        /* Alerts */
        .alert-modern {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
        }

        /* Backdrop */
        .sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1030;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        /* Theme Toggle */
        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 1.2rem;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: var(--border-color);
            color: var(--text-primary);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .top-navbar {
                height: 60px;
            }

            .sidebar {
                top: 60px;
            }

            .main-content {
                margin-top: 60px;
            }

            .search-box {
                display: none;
            }

            .stats-card {
                padding: 1rem;
            }

            .stats-value {
                font-size: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }
    </style>
</head>
<body>
    <!-- Sidebar Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Top Navbar -->
    <nav class="top-navbar">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <button class="btn btn-link text-decoration-none me-3 d-lg-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>AdminPanel
                </a>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="search-box d-none d-md-block">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari pengaduan, siswa..." id="globalSearch">
                </div>

                <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                    <i class="fas fa-moon"></i>
                </button>

                <div class="dropdown">
                    <button class="btn btn-link position-relative" id="notificationBtn" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge">{{ $pending ?? 0 }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" style="width: 300px;">
                        <li><h6 class="dropdown-header">Notifikasi</h6></li>
                        <li><a class="dropdown-item d-flex align-items-start" href="{{ route('admin.pengaduan.masuk') }}">
                            <div class="me-3 mt-1">
                                <i class="fas fa-exclamation-circle text-warning"></i>
                            </div>
                            <div>
                                <div class="fw-semibold">{{ $pending ?? 0 }} Pengaduan Pending</div>
                                <small class="text-muted">Menunggu ditinjau</small>
                            </div>
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="{{ route('admin.pengaduan.masuk') }}">Lihat Semua</a></li>
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btn-link d-flex align-items-center" id="profileBtn" data-bs-toggle="dropdown">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                            {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                        </div>
                        <div class="d-none d-lg-block text-start">
                            <div class="fw-semibold">{{ Auth::user()->nama ?? 'Admin' }}</div>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="sidebar-title">Admin Panel</div>
            <div class="sidebar-subtitle">Sistem Pengaduan Siswa</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Dashboard</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Pengaduan</div>
                <a href="{{ route('admin.pengaduan.masuk') }}" class="nav-link {{ Route::currentRouteName() === 'admin.pengaduan.masuk' ? 'active' : '' }}">
                    <i class="fas fa-inbox"></i>
                    <span>Pengaduan Masuk</span>
                    <span class="badge bg-danger">{{ $pending ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.pengaduan.diproses') }}" class="nav-link {{ Route::currentRouteName() === 'admin.pengaduan.diproses' ? 'active' : '' }}">
                    <i class="fas fa-spinner"></i>
                    <span>Diproses</span>
                    <span class="badge bg-warning">{{ $diproses ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.pengaduan.selesai') }}" class="nav-link {{ Route::currentRouteName() === 'admin.pengaduan.selesai' ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i>
                    <span>Selesai</span>
                    <span class="badge bg-success">{{ $selesai ?? 0 }}</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Data & Laporan</div>
                <a href="{{ route('admin.siswa.index') }}" class="nav-link {{ str_starts_with(Route::currentRouteName(), 'admin.siswa') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Data Siswa</span>
                </a>
                <a href="{{ route('admin.laporan') }}" class="nav-link {{ Route::currentRouteName() === 'admin.laporan' ? 'active' : '' }}">
                    <i class="fas fa-file-pdf"></i>
                    <span>Laporan</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-link {{ Route::currentRouteName() === 'admin.settings' ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-modern">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Ada Kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-modern">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Status Update Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="statusForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" id="pengaduanId" name="pengaduan_id">
                        <div class="mb-3">
                            <label class="form-label">Status Baru</label>
                            <select class="form-select" id="statusSelect" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="diproses">Diproses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" name="catatan" rows="3" placeholder="Tambahkan catatan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            const icon = themeToggle.querySelector('i');
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        });

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        themeToggle.querySelector('i').className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            sidebarBackdrop.classList.toggle('show');
        }

        sidebarToggle?.addEventListener('click', toggleSidebar);
        sidebarBackdrop?.addEventListener('click', toggleSidebar);

        // Close sidebar on mobile when clicking outside
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('show');
                sidebarBackdrop.classList.remove('show');
            }
        });

        // Status Update Function
        function updateStatus(id, currentStatus) {
            document.getElementById('pengaduanId').value = id;
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('statusForm').action = `/admin/pengaduan/${id}/status`;

            new bootstrap.Modal(document.getElementById('statusModal')).show();
        }

        // Global Search
        document.getElementById('globalSearch')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Implement search functionality here
            console.log('Searching for:', searchTerm);
        });

        // Real-time notifications (placeholder)
        function checkNotifications() {
            // Implement real-time notification checking
            fetch('/admin/notifications/count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('notificationBadge');
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'block';
                    } else {
                        badge.style.display = 'none';
                    }
                })
                .catch(err => console.log('Notification check failed'));
        }

        // Check notifications every 30 seconds
        setInterval(checkNotifications, 30000);

        // Loading animation for cards
        document.querySelectorAll('.stats-card').forEach(card => {
            card.classList.add('loading');
            setTimeout(() => card.classList.remove('loading'), 1000);
        });
    </script>
    @stack('scripts')
</body>
</html>
