@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Laporan Pengaduan</h1>
            <p class="text-gray-600 mt-2">Kelola dan download berbagai jenis laporan pengaduan siswa</p>
        </div>

        <!-- Tabs Navigation -->
        <div class="bg-white rounded-lg shadow-md mb-6 border-b border-gray-200">
            <div class="flex gap-0">
                <button onclick="switchTab('bulanan')" id="tab-bulanan" class="tab-btn active px-6 py-3 font-semibold text-gray-700 border-b-2 border-blue-600">
                    <i class="fas fa-calendar-alt mr-2"></i> Laporan Bulanan
                </button>
                <button onclick="switchTab('tahunan')" id="tab-tahunan" class="tab-btn px-6 py-3 font-semibold text-gray-700 hover:text-blue-600">
                    <i class="fas fa-chart-line mr-2"></i> Laporan Tahunan
                </button>
                <button onclick="switchTab('status')" id="tab-status" class="tab-btn px-6 py-3 font-semibold text-gray-700 hover:text-blue-600">
                    <i class="fas fa-list mr-2"></i> Laporan Status
                </button>
                <button onclick="switchTab('siswa')" id="tab-siswa" class="tab-btn px-6 py-3 font-semibold text-gray-700 hover:text-blue-600">
                    <i class="fas fa-users mr-2"></i> Laporan Siswa
                </button>
            </div>
        </div>

        <!-- TAB 1: Laporan Bulanan -->
        <div id="tab-bulanan-content" class="tab-content">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Laporan Bulanan</h2>

                <!-- Filter -->
                <div class="grid grid-cols-4 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bulan</label>
                        <select id="bulan-select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                        <select id="tahun-select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="2024">2024</option>
                            <option value="2025" selected>2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button onclick="loadLaporanBulanan()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-sync-alt mr-2"></i> Tampilkan
                        </button>
                    </div>
                    <div class="flex items-end">
                        <button onclick="printLaporan('bulanan')" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-print mr-2"></i> Cetak
                        </button>
                    </div>
                </div>

                <!-- Stats -->
                <div id="bulanan-stats" class="grid grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-gray-600 text-sm font-semibold">Total Pengaduan</p>
                        <p class="text-3xl font-bold text-blue-600" id="bulanan-total">0</p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                        <p class="text-gray-600 text-sm font-semibold">Pending</p>
                        <p class="text-3xl font-bold text-red-600" id="bulanan-pending">0</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <p class="text-gray-600 text-sm font-semibold">Diproses</p>
                        <p class="text-3xl font-bold text-yellow-600" id="bulanan-diproses">0</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <p class="text-gray-600 text-sm font-semibold">Selesai</p>
                        <p class="text-3xl font-bold text-green-600" id="bulanan-selesai">0</p>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">ID</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Judul</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Dari</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody id="bulanan-table">
                            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Klik "Tampilkan" untuk melihat laporan</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 2: Laporan Tahunan -->
        <div id="tab-tahunan-content" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Laporan Tahunan</h2>

                <!-- Filter -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                        <select id="tahun-tahunan-select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="2024">2024</option>
                            <option value="2025" selected>2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button onclick="loadLaporanTahunan()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-sync-alt mr-2"></i> Tampilkan
                        </button>
                    </div>
                    <div class="flex items-end">
                        <button onclick="printLaporan('tahunan')" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-print mr-2"></i> Cetak
                        </button>
                    </div>
                </div>

                <!-- Stats -->
                <div id="tahunan-stats" class="grid grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-gray-600 text-sm font-semibold">Total Pengaduan</p>
                        <p class="text-3xl font-bold text-blue-600" id="tahunan-total">0</p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                        <p class="text-gray-600 text-sm font-semibold">Pending</p>
                        <p class="text-3xl font-bold text-red-600" id="tahunan-pending">0</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <p class="text-gray-600 text-sm font-semibold">Diproses</p>
                        <p class="text-3xl font-bold text-yellow-600" id="tahunan-diproses">0</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <p class="text-gray-600 text-sm font-semibold">Selesai</p>
                        <p class="text-3xl font-bold text-green-600" id="tahunan-selesai">0</p>
                    </div>
                </div>

                <!-- Chart -->
                <div class="mb-6">
                    <canvas id="tahunanChart"></canvas>
                </div>

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">ID</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Judul</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Dari</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tahunan-table">
                            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Klik "Tampilkan" untuk melihat laporan</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 3: Laporan Status -->
        <div id="tab-status-content" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Laporan Status Pengaduan</h2>

                <!-- Filter -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                        <select id="periode-select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="1">Bulan Ini</option>
                            <option value="3">3 Bulan Terakhir</option>
                            <option value="6">6 Bulan Terakhir</option>
                            <option value="12">1 Tahun</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button onclick="loadLaporanStatus()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-sync-alt mr-2"></i> Tampilkan
                        </button>
                    </div>
                    <div class="flex items-end">
                        <button onclick="printLaporan('status')" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-print mr-2"></i> Cetak
                        </button>
                    </div>
                </div>

                <!-- Stats -->
                <div id="status-stats" class="grid grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <p class="text-gray-600 text-sm font-semibold">Total Pengaduan</p>
                        <p class="text-3xl font-bold text-blue-600" id="status-total">0</p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                        <p class="text-gray-600 text-sm font-semibold">Pending</p>
                        <p class="text-3xl font-bold text-red-600" id="status-pending">0</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <p class="text-gray-600 text-sm font-semibold">Diproses</p>
                        <p class="text-3xl font-bold text-yellow-600" id="status-diproses">0</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <p class="text-gray-600 text-sm font-semibold">Selesai</p>
                        <p class="text-3xl font-bold text-green-600" id="status-selesai">0</p>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">ID</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Judul</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Dari</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody id="status-table">
                            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Klik "Tampilkan" untuk melihat laporan</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 4: Laporan Siswa -->
        <div id="tab-siswa-content" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Laporan Data Siswa</h2>

                <!-- Filter -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Urutkan Berdasarkan</label>
                        <select id="urutkan-select" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="pengaduan">Jumlah Pengaduan</option>
                            <option value="nama">Nama (A-Z)</option>
                            <option value="terbaru">Terbaru Terdaftar</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button onclick="loadLaporanSiswa()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-sync-alt mr-2"></i> Tampilkan
                        </button>
                    </div>
                    <div class="flex items-end">
                        <button onclick="printLaporan('siswa')" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            <i class="fas fa-print mr-2"></i> Cetak
                        </button>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">No</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Username</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">NIS</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Kelas</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Pengaduan</th>
                            </tr>
                        </thead>
                        <tbody id="siswa-table">
                            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Klik "Tampilkan" untuk melihat laporan</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    let tahunanChartInstance = null;

    function switchTab(tab) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('active');
            el.classList.remove('border-b-2', 'border-blue-600');
        });

        // Show selected tab
        document.getElementById(`tab-${tab}-content`).classList.remove('hidden');
        document.getElementById(`tab-${tab}`).classList.add('active', 'border-b-2', 'border-blue-600');
    }

    function getStatusBadge(status) {
        const badges = {
            'pending': '<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">Pending</span>',
            'diproses': '<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">Diproses</span>',
            'selesai': '<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Selesai</span>',
        };
        return badges[status] || status;
    }

    function formatDate(dateString) {
        return new Date(dateString).toLocaleString('id-ID', { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Load Laporan Bulanan
    function loadLaporanBulanan() {
        const bulan = document.getElementById('bulan-select').value;
        const tahun = document.getElementById('tahun-select').value;

        fetch(`/admin/laporan/bulanan?bulan=${bulan}&tahun=${tahun}&ajax=1`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('bulanan-total').textContent = data.stats.total;
                document.getElementById('bulanan-pending').textContent = data.stats.pending;
                document.getElementById('bulanan-diproses').textContent = data.stats.diproses;
                document.getElementById('bulanan-selesai').textContent = data.stats.selesai;

                let rows = '';
                if (data.pengaduan.length === 0) {
                    rows = '<tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada data</td></tr>';
                } else {
                    data.pengaduan.forEach((p, i) => {
                        rows += `
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3">#${String(p.id).padStart(5, '0')}</td>
                                <td class="px-4 py-3">${p.judul}</td>
                                <td class="px-4 py-3">${p.user.nama}</td>
                                <td class="px-4 py-3">${formatDate(p.tanggal_lapor)}</td>
                                <td class="px-4 py-3">${getStatusBadge(p.status)}</td>
                            </tr>
                        `;
                    });
                }
                document.getElementById('bulanan-table').innerHTML = rows;
            })
            .catch(error => console.error('Error:', error));
    }

    // Load Laporan Tahunan
    function loadLaporanTahunan() {
        const tahun = document.getElementById('tahun-tahunan-select').value;

        fetch(`/admin/laporan/tahunan?tahun=${tahun}&ajax=1`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('tahunan-total').textContent = data.stats.total;
                document.getElementById('tahunan-pending').textContent = data.stats.pending;
                document.getElementById('tahunan-diproses').textContent = data.stats.diproses;
                document.getElementById('tahunan-selesai').textContent = data.stats.selesai;

                let rows = '';
                if (data.pengaduan.length === 0) {
                    rows = '<tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada data</td></tr>';
                } else {
                    data.pengaduan.forEach((p, i) => {
                        rows += `
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3">#${String(p.id).padStart(5, '0')}</td>
                                <td class="px-4 py-3">${p.judul}</td>
                                <td class="px-4 py-3">${p.user.nama}</td>
                                <td class="px-4 py-3">${formatDate(p.tanggal_lapor)}</td>
                                <td class="px-4 py-3">${getStatusBadge(p.status)}</td>
                            </tr>
                        `;
                    });
                }
                document.getElementById('tahunan-table').innerHTML = rows;

                // Update Chart
                const ctx = document.getElementById('tahunanChart').getContext('2d');
                if (tahunanChartInstance) {
                    tahunanChartInstance.destroy();
                }
                tahunanChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Jumlah Pengaduan',
                            data: data.chartData,
                            backgroundColor: '#3b82f6',
                            borderColor: '#1e40af',
                            borderWidth: 2,
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: Math.max(...data.chartData) + 5
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Load Laporan Status
    function loadLaporanStatus() {
        const periode = document.getElementById('periode-select').value;

        fetch(`/admin/laporan/status?periode=${periode}&ajax=1`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('status-total').textContent = data.stats.total;
                document.getElementById('status-pending').textContent = data.stats.pending;
                document.getElementById('status-diproses').textContent = data.stats.diproses;
                document.getElementById('status-selesai').textContent = data.stats.selesai;

                let rows = '';
                if (data.pengaduan.length === 0) {
                    rows = '<tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada data</td></tr>';
                } else {
                    data.pengaduan.forEach((p, i) => {
                        rows += `
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3">#${String(p.id).padStart(5, '0')}</td>
                                <td class="px-4 py-3">${p.judul}</td>
                                <td class="px-4 py-3">${p.user.nama}</td>
                                <td class="px-4 py-3">${formatDate(p.tanggal_lapor)}</td>
                                <td class="px-4 py-3">${getStatusBadge(p.status)}</td>
                            </tr>
                        `;
                    });
                }
                document.getElementById('status-table').innerHTML = rows;
            })
            .catch(error => console.error('Error:', error));
    }

    // Load Laporan Siswa
    function loadLaporanSiswa() {
        const urutkan = document.getElementById('urutkan-select').value;

        fetch(`/admin/laporan/siswa?urutkan=${urutkan}&ajax=1`)
            .then(response => response.json())
            .then(data => {
                let rows = '';
                if (data.siswa.length === 0) {
                    rows = '<tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Tidak ada data</td></tr>';
                } else {
                    data.siswa.forEach((s, i) => {
                        rows += `
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-3">${i + 1}</td>
                                <td class="px-4 py-3">${s.nama}</td>
                                <td class="px-4 py-3">${s.username}</td>
                                <td class="px-4 py-3">${s.nis || '-'}</td>
                                <td class="px-4 py-3">Kelas ${s.kelas || '-'}</td>
                                <td class="px-4 py-3"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">${s.pengaduan_count || 0}</span></td>
                            </tr>
                        `;
                    });
                }
                document.getElementById('siswa-table').innerHTML = rows;
            })
            .catch(error => console.error('Error:', error));
    }

    // Print Laporan
    function printLaporan(type) {
        window.print();
    }

    // Auto load bulanan on page load
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        document.getElementById('bulan-select').value = now.getMonth() + 1;
    });
</script>

<style>
    @media print {
        body {
            background: white;
        }
        .no-print {
            display: none;
        }
    }
</style>
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
