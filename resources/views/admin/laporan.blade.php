@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Laporan</h1>
            <p class="text-gray-600 mt-2">Generate dan unduh laporan pengaduan siswa</p>
        </div>
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Report Options -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Laporan Bulanan -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-xl">
                    <i class="fas fa-calendar"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Laporan Bulanan</h3>
                    <p class="text-sm text-gray-600">Data pengaduan per bulan</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Pilih Bulan</label>
                    <input type="month" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </button>
            </div>
        </div>

        <!-- Laporan Tahunan -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-xl">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Laporan Tahunan</h3>
                    <p class="text-sm text-gray-600">Data pengaduan per tahun</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Pilih Tahun</label>
                    <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>2026</option>
                        <option>2025</option>
                        <option>2024</option>
                    </select>
                </div>
                <button class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </button>
            </div>
        </div>

        <!-- Laporan Status -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 text-xl">
                    <i class="fas fa-tasks"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Laporan Status</h3>
                    <p class="text-sm text-gray-600">Distribusi status pengaduan</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Periode</label>
                    <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Bulan Ini</option>
                        <option>3 Bulan Terakhir</option>
                        <option>6 Bulan Terakhir</option>
                        <option>1 Tahun</option>
                    </select>
                </div>
                <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </button>
            </div>
        </div>

        <!-- Laporan Siswa -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600 text-xl">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Laporan Siswa</h3>
                    <p class="text-sm text-gray-600">Data siswa dan pengaduan mereka</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Urutkan Berdasarkan</label>
                    <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Paling Banyak Pengaduan</option>
                        <option>Nama A-Z</option>
                        <option>Terbaru Bergabung</option>
                    </select>
                </div>
                <button class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-download mr-2"></i> Download Excel
                </button>
            </div>
        </div>
    </div>

    <!-- Laporan Terbaru -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-6">Laporan Terbaru yang Diunduh</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Jenis Laporan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Periode</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Tanggal Unduh</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Ukuran</th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-900 text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                Laporan Bulanan
                            </span>
                        </td>
                        <td class="py-4 px-4 text-gray-600 text-sm">Januari 2026</td>
                        <td class="py-4 px-4 text-gray-600 text-sm">15 Januari 2026, 10:30</td>
                        <td class="py-4 px-4 text-gray-600 text-sm">2.5 MB</td>
                        <td class="py-4 px-4 text-center">
                            <button class="text-blue-600 hover:text-blue-700 text-sm">
                                <i class="fas fa-download"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                Laporan Status
                            </span>
                        </td>
                        <td class="py-4 px-4 text-gray-600 text-sm">6 Bulan Terakhir</td>
                        <td class="py-4 px-4 text-gray-600 text-sm">14 Januari 2026, 15:45</td>
                        <td class="py-4 px-4 text-gray-600 text-sm">1.8 MB</td>
                        <td class="py-4 px-4 text-center">
                            <button class="text-blue-600 hover:text-blue-700 text-sm">
                                <i class="fas fa-download"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
