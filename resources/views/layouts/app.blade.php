<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem Pengaduan Siswa</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="logo-text">SPS</span>
                </div>
                <h5 class="sidebar-title">Sistem Pengaduan Siswa</h5>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="nav-item @if(Route::currentRouteName() == 'dashboard') active @endif">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Pengaduan</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span>Siswa</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Laporan</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
                <div class="container-fluid">
                    <button class="btn btn-link toggle-sidebar me-3" id="toggleSidebar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="navbar-brand d-lg-none">
                        <i class="fas fa-graduation-cap"></i> SPS
                    </div>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <!-- Notifications -->
                        <div class="dropdown">
                            <button class="btn btn-link notification-btn" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge badge-notification">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end notification-menu" aria-labelledby="notificationDropdown">
                                <li><h6 class="dropdown-header">Notifikasi</h6></li>
                                <li><a class="dropdown-item" href="#">Pengaduan baru dari Siswa A</a></li>
                                <li><a class="dropdown-item" href="#">Pengaduan diperbarui oleh Admin</a></li>
                                <li><a class="dropdown-item" href="#">Laporan bulanan siap di-download</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="#">Lihat semua notifikasi</a></li>
                            </ul>
                        </div>

                        <!-- User Profile -->
                        <div class="dropdown">
                            <button class="btn btn-link user-profile" id="userDropdown" data-bs-toggle="dropdown">
                                <div class="avatar-img">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="d-none d-sm-inline">{{ Auth::user()->nama }}</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><h6 class="dropdown-header">{{ Auth::user()->nama }}</h6></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> Profil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-lock"></i> Ubah Password</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="page-content">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="footer bg-light border-top">
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0">&copy; 2026 Sistem Pengaduan Siswa. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-0">Version 1.0</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
