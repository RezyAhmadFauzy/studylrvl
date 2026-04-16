<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Sistem Pengaduan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-slate-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div id="adminSidebar" class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 text-white shadow-2xl transform transition-transform duration-300 ease-in-out md:translate-x-0 -translate-x-full z-50">
            <!-- Logo -->
            <div class="p-6 border-b border-blue-700 flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-lg">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold">TANGSEL</h1>
                    <p class="text-xs text-blue-200">Pengaduan Siswa</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="admin-nav-item {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Data Siswa -->
                <a href="{{ route('admin.siswa') }}" 
                   class="admin-nav-item {{ Route::currentRouteName() === 'admin.siswa' ? 'active' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Data Siswa</span>
                </a>

                <!-- Pengaduan Divider -->
                <div class="pt-4 pb-2">
                    <p class="text-xs font-semibold text-blue-300 px-3 uppercase tracking-wider">Pengaduan</p>
                </div>

                <!-- Pengaduan Masuk -->
                <a href="{{ route('admin.pengaduan.masuk') }}" 
                   class="admin-nav-item {{ Route::currentRouteName() === 'admin.pengaduan.masuk' ? 'active' : '' }}">
                    <i class="fas fa-inbox w-5"></i>
                    <span>Pengaduan Masuk</span>
                    <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full font-semibold">{{ $pending ?? 0 }}</span>
                </a>

                <!-- Pengaduan Diproses -->
                <a href="{{ route('admin.pengaduan.diproses') }}" 
                   class="admin-nav-item {{ Route::currentRouteName() === 'admin.pengaduan.diproses' ? 'active' : '' }}">
                    <i class="fas fa-spinner w-5"></i>
                    <span>Diproses</span>
                    <span class="ml-auto bg-yellow-500 text-xs px-2 py-1 rounded-full font-semibold text-gray-900">{{ $diproses ?? 0 }}</span>
                </a>

                <!-- Pengaduan Selesai -->
                <a href="{{ route('admin.pengaduan.selesai') }}" 
                   class="admin-nav-item {{ Route::currentRouteName() === 'admin.pengaduan.selesai' ? 'active' : '' }}">
                    <i class="fas fa-check-circle w-5"></i>
                    <span>Selesai</span>
                    <span class="ml-auto bg-green-500 text-xs px-2 py-1 rounded-full font-semibold">{{ $selesai ?? 0 }}</span>
                </a>

                <!-- Divider -->
                <div class="pt-4 pb-2">
                    <p class="text-xs font-semibold text-blue-300 px-3 uppercase tracking-wider">Lainnya</p>
                </div>

                <!-- Laporan -->
                <a href="{{ route('admin.laporan') }}" 
                   class="admin-nav-item {{ Route::currentRouteName() === 'admin.laporan' ? 'active' : '' }}">
                    <i class="fas fa-file-pdf w-5"></i>
                    <span>Laporan</span>
                </a>

                <!-- Settings -->
                <a href="{{ route('admin.settings') }}" 
                   class="admin-nav-item {{ Route::currentRouteName() === 'admin.settings' ? 'active' : '' }}">
                    <i class="fas fa-cog w-5"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <!-- Logout Button at Bottom -->
            <div class="absolute bottom-6 left-4 right-4">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full admin-nav-item bg-red-600 hover:bg-red-700 text-center">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm sticky top-0 z-40">
                <div class="px-6 py-4 flex items-center justify-between">
                    <!-- Mobile Menu Toggle -->
                    <button id="toggleSidebarBtn" class="md:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Search Bar -->
                    <div class="hidden md:block flex-1 mx-8">
                        <div class="relative">
                            <input type="text" placeholder="Cari pengaduan, siswa..." 
                                   class="w-full px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                            <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center gap-6">
                        <!-- Notifications -->
                        <div class="relative group">
                            <button class="relative text-gray-600 hover:text-gray-900 transition">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">3</span>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="p-4 border-b border-gray-100">
                                    <h3 class="font-semibold text-gray-900">Notifikasi</h3>
                                </div>
                                <div class="divide-y max-h-80 overflow-y-auto">
                                    <a href="#" class="p-4 hover:bg-gray-50 transition flex gap-3">
                                        <div class="w-3 h-3 bg-red-500 rounded-full mt-2 flex-shrink-0"></div>
                                        <div>
                                            <p class="font-semibold text-sm text-gray-900">Pengaduan Baru</p>
                                            <p class="text-xs text-gray-600">Pengaduan baru dari Budi Santoso</p>
                                            <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
                                        </div>
                                    </a>
                                    <a href="#" class="p-4 hover:bg-gray-50 transition flex gap-3">
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full mt-2 flex-shrink-0"></div>
                                        <div>
                                            <p class="font-semibold text-sm text-gray-900">Pengaduan Diproses</p>
                                            <p class="text-xs text-gray-600">Pengaduan ID #00124 sedang diproses</p>
                                            <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                                        </div>
                                    </a>
                                    <a href="#" class="p-4 hover:bg-gray-50 transition flex gap-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                                        <div>
                                            <p class="font-semibold text-sm text-gray-900">Pengaduan Selesai</p>
                                            <p class="text-xs text-gray-600">Pengaduan ID #00122 telah selesai</p>
                                            <p class="text-xs text-gray-400 mt-1">3 jam yang lalu</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-3 text-center border-t border-gray-100">
                                    <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lihat Semua Notifikasi</a>
                                </div>
                            </div>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-lg transition">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    {{ substr(Auth::user()->nama ?? 'A', 0, 1) }}
                                </div>
                                <div class="hidden md:block text-left">
                                    <p class="font-semibold text-sm text-gray-900">{{ Auth::user()->nama ?? 'Admin' }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->role ?? 'admin' }}</p>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-600"></i>
                            </button>
                            <!-- User Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-lg transition">
                                    <i class="fas fa-user-circle mr-2"></i> Profil
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    <i class="fas fa-cog mr-2"></i> Pengaturan
                                </a>
                                <hr class="my-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-lg transition">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-auto">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex gap-3">
                                <i class="fas fa-exclamation-circle text-red-600 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold text-red-800 mb-2">Ada Kesalahan</h3>
                                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex gap-3 items-start">
                            <i class="fas fa-check-circle text-green-600 mt-1"></i>
                            <div>
                                <h3 class="font-semibold text-green-800">Berhasil</h3>
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <style>
        .admin-nav-item {
            @apply flex items-center gap-3 px-4 py-3 text-blue-100 rounded-lg transition-all duration-200 hover:bg-blue-700 hover:text-white;
        }

        .admin-nav-item.active {
            @apply bg-blue-600 text-white shadow-lg;
        }

        .admin-nav-item i {
            @apply flex-shrink-0;
        }
    </style>

    <script>
        // Sidebar Toggle
        const toggleBtn = document.getElementById('toggleSidebarBtn');
        const sidebar = document.getElementById('adminSidebar');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (sidebar && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

        // Close sidebar on resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
            }
        });
    </script>
</body>
</html>
