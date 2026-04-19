<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Sistem Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        body { background: #f4f7fb; }
        .navbar { z-index: 1051; }
        .sidebar {
            width: 18rem;
            z-index: 1050;
            padding-top: 5.5rem;
            background: #0f172a;
            transition: transform .3s ease;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.78);
            transition: background .2s ease, color .2s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(13,110,253,.18);
            box-shadow: inset 3px 0 0 rgba(13,110,253,.75);
        }
        .sidebar .nav-link .badge {
            min-width: 2.25rem;
            font-size: .75rem;
        }
        .sidebar .btn-danger {
            border-radius: 0.85rem;
        }
        .main-content {
            margin-left: 18rem;
            margin-top: 56px;
        }
        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid rgba(15, 23, 42, .08);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1040;
            height: 56px;
            display: flex;
            align-items: center;
        }
        .sidebar-footer {
            padding: 1rem 1rem 1.5rem;
        }
        .sidebar-footer .btn {
            width: 100%;
        }
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); position: fixed; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom fixed-top shadow-sm">
        <div class="container-fluid px-3 px-lg-4">
            <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle" type="button">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand fw-bold text-uppercase" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-none d-md-flex ms-4 w-100" role="search">
                    <input class="form-control rounded-pill border-0 bg-light" type="search" placeholder="Cari pengaduan, siswa, laporan..." aria-label="Search">
                </form>
            </div>

            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn btn-light border position-relative d-none d-sm-inline-flex align-items-center shadow-sm" type="button">
                    <i class="bi bi-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </button>
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none" href="#" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 44px; height: 44px;">{{ substr(Auth::user()->nama ?? 'A', 0, 1) }}</div>
                        <div class="d-none d-sm-block text-start">
                            <div class="fw-semibold text-dark">{{ Auth::user()->nama ?? 'Admin' }}</div>
                            <small class="text-muted">{{ Auth::user()->role ?? 'Administrator' }}</small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <aside id="adminSidebar" class="sidebar bg-dark text-white position-fixed top-0 bottom-0 start-0 pt-5 pt-lg-4 shadow-lg">
            <div class="px-3 pb-3 border-bottom border-secondary d-none d-lg-block text-center">
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">
                    <div class="fs-4 fw-bold">TANGSEL</div>
                    <div class="small text-secondary">Pengaduan Siswa</div>
                </a>
            </div>
            <nav class="nav flex-column px-2 px-lg-3 pt-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center justify-content-between rounded-3 mb-1 px-3 py-2 {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
                    <span><i class="bi bi-speedometer2 me-2"></i>Dashboard</span>
                </a>
                <a href="{{ route('admin.pengaduan.masuk') }}" class="nav-link d-flex align-items-center justify-content-between rounded-3 mb-1 px-3 py-2 {{ Route::currentRouteName() === 'admin.pengaduan.masuk' ? 'active' : '' }}">
                    <span><i class="bi bi-inbox me-2"></i>Pengaduan Masuk</span>
                    <span class="badge bg-danger rounded-pill">{{ $pending ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.pengaduan.diproses') }}" class="nav-link d-flex align-items-center justify-content-between rounded-3 mb-1 px-3 py-2 {{ Route::currentRouteName() === 'admin.pengaduan.diproses' ? 'active' : '' }}">
                    <span><i class="bi bi-arrow-repeat me-2"></i>Diproses</span>
                    <span class="badge bg-warning text-dark rounded-pill">{{ $diproses ?? 0 }}</span>
                </a>
                <a href="{{ route('admin.pengaduan.selesai') }}" class="nav-link d-flex align-items-center justify-content-between rounded-3 mb-1 px-3 py-2 {{ Route::currentRouteName() === 'admin.pengaduan.selesai' ? 'active' : '' }}">
                    <span><i class="bi bi-check-circle me-2"></i>Selesai</span>
                    <span class="badge bg-success rounded-pill">{{ $selesai ?? 0 }}</span>
                </a>
                <div class="mt-4 px-3 text-uppercase text-secondary small tracking-wider">Data & Laporan</div>
                <a href="{{ route('admin.siswa.index') }}" class="nav-link d-flex align-items-center rounded-3 mb-1 px-3 py-2 {{ str_starts_with(Route::currentRouteName(), 'admin.siswa') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i>Data Siswa
                </a>
                <a href="{{ route('admin.laporan') }}" class="nav-link d-flex align-items-center rounded-3 mb-1 px-3 py-2 {{ Route::currentRouteName() === 'admin.laporan' ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text me-2"></i>Laporan
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-link d-flex align-items-center rounded-3 mb-1 px-3 py-2 {{ Route::currentRouteName() === 'admin.settings' ? 'active' : '' }}">
                    <i class="bi bi-gear me-2"></i>Pengaturan
                </a>
            </nav>

            <div class="position-absolute bottom-0 start-0 end-0 p-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm w-100 rounded-3">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-fill main-content">
            <div class="container-fluid py-4">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-4 shadow-sm">
                        <h6 class="mb-2 fw-semibold">Ada Kesalahan</h6>
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success rounded-4 shadow-sm">
                        <div class="fw-semibold">Berhasil</div>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <div id="sidebarBackdrop" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const toggleBtn = document.getElementById('sidebarToggle');

        const openSidebar = () => {
            sidebar.classList.add('show');
            backdrop.classList.remove('d-none');
        };

        const closeSidebar = () => {
            sidebar.classList.remove('show');
            backdrop.classList.add('d-none');
        };

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                if (sidebar.classList.contains('show')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });
        }

        backdrop.addEventListener('click', closeSidebar);

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
