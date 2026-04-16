@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Pengaturan</h1>
            <p class="text-gray-600 mt-2">Kelola pengaturan aplikasi Sistem Pengaduan</p>
        </div>
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Settings Tabs -->
    <div class="flex gap-4 border-b border-gray-200 overflow-x-auto">
        <button class="settings-tab active px-6 py-3 border-b-2 border-blue-600 font-semibold text-blue-600 whitespace-nowrap" data-tab="umum">
            <i class="fas fa-cog mr-2"></i> Umum
        </button>
        <button class="settings-tab px-6 py-3 border-b-2 border-transparent font-semibold text-gray-600 hover:text-gray-900 whitespace-nowrap" data-tab="email">
            <i class="fas fa-envelope mr-2"></i> Email
        </button>
        <button class="settings-tab px-6 py-3 border-b-2 border-transparent font-semibold text-gray-600 hover:text-gray-900 whitespace-nowrap" data-tab="security">
            <i class="fas fa-lock mr-2"></i> Keamanan
        </button>
        <button class="settings-tab px-6 py-3 border-b-2 border-transparent font-semibold text-gray-600 hover:text-gray-900 whitespace-nowrap" data-tab="notifikasi">
            <i class="fas fa-bell mr-2"></i> Notifikasi
        </button>
    </div>

    <!-- Tab Content -->
    <div class="bg-white rounded-lg shadow-sm p-8">
        <!-- Umum Settings -->
        <div id="tab-umum" class="tab-content">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Pengaturan Umum</h2>
            <form class="space-y-6 max-w-2xl">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Aplikasi</label>
                    <input type="text" value="Sistem Pengaduan Siswa" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Sekolah</label>
                    <input type="text" value="SMA TANGSEL DIGITAL" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi Singkat</label>
                    <textarea class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4">Platform pengaduan online untuk siswa SMA TANGSEL DIGITAL. Memudahkan siswa untuk melaporkan keluhan atau saran kepada pihak sekolah.</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email Admin</label>
                    <input type="email" value="admin@sekolah.com" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Telepon</label>
                    <input type="tel" value="(021) 1234-5678" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Alamat</label>
                    <textarea class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3">Jl. Merdeka No. 123, Tangerang Selatan, Banten 15314</textarea>
                </div>

                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Email Settings -->
        <div id="tab-email" class="tab-content hidden">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Pengaturan Email</h2>
            <form class="space-y-6 max-w-2xl">
                <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-blue-900">Konfigurasi email untuk mengirim notifikasi kepada siswa dan admin.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">SMTP Server</label>
                    <input type="text" value="smtp.gmail.com" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">SMTP Port</label>
                    <input type="number" value="587" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email Pengirim</label>
                    <input type="email" value="noreply@sekolah.com" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                    <input type="password" value="••••••••" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded">
                        <span class="text-sm font-semibold text-gray-900">Gunakan TLS/SSL</span>
                    </label>
                </div>

                <button type="button" class="px-6 py-2 border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-lg font-semibold transition">
                    <i class="fas fa-envelope mr-2"></i> Test Email
                </button>

                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Security Settings -->
        <div id="tab-security" class="tab-content hidden">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Pengaturan Keamanan</h2>
            <form class="space-y-6 max-w-2xl">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-4">Password Admin Saat Ini</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-4">Password Baru</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-4">Konfirmasi Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-900">
                        <i class="fas fa-info-circle mr-2"></i>
                        Password harus minimal 8 karakter dengan kombinasi huruf, angka, dan simbol.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-4">Session Timeout (menit)</label>
                    <input type="number" value="30" min="5" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" checked class="w-4 h-4 rounded">
                        <span class="text-sm font-semibold text-gray-900">Aktifkan Two-Factor Authentication (2FA)</span>
                    </label>
                </div>

                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Update Password
                </button>
            </form>
        </div>

        <!-- Notification Settings -->
        <div id="tab-notifikasi" class="tab-content hidden">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Pengaturan Notifikasi</h2>
            <div class="space-y-6 max-w-2xl">
                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Notifikasi Pengaduan</h3>
                    
                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" checked class="w-4 h-4 rounded mt-1">
                        <div>
                            <p class="font-semibold text-gray-900">Pengaduan Baru</p>
                            <p class="text-sm text-gray-600">Kirim notifikasi ketika ada pengaduan baru masuk</p>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" checked class="w-4 h-4 rounded mt-1">
                        <div>
                            <p class="font-semibold text-gray-900">Pengaduan Ditinjau</p>
                            <p class="text-sm text-gray-600">Kirim notifikasi ketika pengaduan mulai ditinjau</p>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" checked class="w-4 h-4 rounded mt-1">
                        <div>
                            <p class="font-semibold text-gray-900">Pengaduan Selesai</p>
                            <p class="text-sm text-gray-600">Kirim notifikasi ketika pengaduan selesai ditangani</p>
                        </div>
                    </label>
                </div>

                <div class="space-y-4 pt-6 border-t border-gray-200">
                    <h3 class="font-semibold text-gray-900">Saluran Notifikasi</h3>
                    
                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" checked class="w-4 h-4 rounded mt-1">
                        <div>
                            <p class="font-semibold text-gray-900">Email</p>
                            <p class="text-sm text-gray-600">Notifikasi melalui email</p>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" class="w-4 h-4 rounded mt-1">
                        <div>
                            <p class="font-semibold text-gray-900">SMS</p>
                            <p class="text-sm text-gray-600">Notifikasi melalui SMS (Opsional)</p>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" checked class="w-4 h-4 rounded mt-1">
                        <div>
                            <p class="font-semibold text-gray-900">Push Notification</p>
                            <p class="text-sm text-gray-600">Notifikasi browser</p>
                        </div>
                    </label>
                </div>

                <button class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Simpan Pengaturan Notifikasi
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Tab switching
    document.querySelectorAll('.settings-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const tabName = tab.dataset.tab;
            
            // Remove active class from all tabs
            document.querySelectorAll('.settings-tab').forEach(t => {
                t.classList.remove('active', 'border-blue-600', 'text-blue-600');
                t.classList.add('border-transparent', 'text-gray-600');
            });
            
            // Add active class to clicked tab
            tab.classList.add('active', 'border-blue-600', 'text-blue-600');
            tab.classList.remove('border-transparent', 'text-gray-600');
            
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show active tab content
            document.getElementById(`tab-${tabName}`).classList.remove('hidden');
        });
    });
</script>

@endsection
