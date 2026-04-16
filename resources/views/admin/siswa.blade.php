@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Data Siswa</h1>
            <p class="text-gray-600 mt-2">Kelola data siswa yang terdaftar dalam sistem</p>
        </div>
        <button onclick="openAddSiswaModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Siswa
        </button>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Cari Siswa</label>
                <input type="text" placeholder="Nama atau username..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Kelas</label>
                <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    <option value="X">Kelas X</option>
                    <option value="XI">Kelas XI</option>
                    <option value="XII">Kelas XII</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">No</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Nama Siswa</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Username</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Kelas</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Pengaduan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Status</th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-900 text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @for ($i = 1; $i <= 10; $i++)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 text-gray-600 text-sm">{{ $i }}</td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    S
                                </div>
                                <p class="font-semibold text-gray-900">Siswa Nama {{ $i }}</p>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-gray-600 text-sm">siswa{{ $i }}</td>
                        <td class="py-4 px-4 text-gray-600 text-sm">{{ ['X', 'XI', 'XII'][rand(0, 2)] }}</td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                {{ rand(0, 5) }} laporan
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                <span class="w-2 h-2 bg-green-800 rounded-full mr-2"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="editSiswa()" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-700 text-sm font-semibold">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-600">Menampilkan 1-10 dari 342 siswa</p>
            <div class="flex gap-2">
                <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition">Sebelumnya</button>
                <button class="px-3 py-2 bg-blue-600 text-white rounded-lg">1</button>
                <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition">2</button>
                <button class="px-3 py-2 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition">Selanjutnya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Siswa -->
<div id="siswaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Tambah Siswa Baru</h3>
        </div>
        <form class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Siswa</label>
                    <input type="text" placeholder="Masukkan nama siswa..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Username</label>
                    <input type="text" placeholder="Masukkan username..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email</label>
                    <input type="email" placeholder="Masukkan email..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Kelas</label>
                    <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Pilih Kelas</option>
                        <option>Kelas X</option>
                        <option>Kelas XI</option>
                        <option>Kelas XII</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                    <input type="password" placeholder="Masukkan password..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Konfirmasi Password</label>
                    <input type="password" placeholder="Konfirmasi password..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </form>
        <div class="p-6 bg-gray-50 flex gap-3 justify-end border-t border-gray-100">
            <button type="button" onclick="closeSiswaModal()" class="px-4 py-2 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">
                Batal
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
    function openAddSiswaModal() {
        document.getElementById('siswaModal').classList.remove('hidden');
    }

    function closeSiswaModal() {
        document.getElementById('siswaModal').classList.add('hidden');
    }

    function editSiswa() {
        document.getElementById('siswaModal').classList.remove('hidden');
    }

    document.getElementById('siswaModal').addEventListener('click', (e) => {
        if (e.target.id === 'siswaModal') {
            closeSiswaModal();
        }
    });
</script>

@endsection
