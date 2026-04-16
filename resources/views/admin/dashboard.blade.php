@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-2">Selamat datang kembali, <span class="font-semibold">{{ Auth::user()->nama }}</span>! 👋</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-600">Terakhir login:</p>
            <p class="font-semibold text-gray-900">{{ Auth::user()->updated_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Siswa -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow duration-200 border-t-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Siswa</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">342</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 text-lg">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Total Pengaduan -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow duration-200 border-t-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pengaduan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPengaduan }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 8% dari bulan lalu
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 text-lg">
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
        </div>

        <!-- Pengaduan Pending -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow duration-200 border-t-4 border-red-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pengaduan Pending</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pending }}</p>
                    <p class="text-xs text-red-600 mt-2">
                        <i class="fas fa-exclamation-circle"></i> Butuh ditinjau
                    </p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-600 text-lg">
                    <i class="fas fa-hourglass-start"></i>
                </div>
            </div>
        </div>

        <!-- Pengaduan Selesai -->
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow duration-200 border-t-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pengaduan Selesai</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $selesai }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-check-circle"></i> Selesai ditangani
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 text-lg">
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pengaduan Per Bulan -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-900">Pengaduan Per Bulan</h2>
                <p class="text-sm text-gray-600">Statistik pengaduan 12 bulan terakhir</p>
            </div>
            <div class="relative h-80">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-900">Distribusi Status</h2>
                <p class="text-sm text-gray-600">Status pengaduan saat ini</p>
            </div>
            <div class="relative h-80">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Activity Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-900">Aktivitas 7 Hari Terakhir</h2>
                <p class="text-sm text-gray-600">Tren pengaduan harian</p>
            </div>
            <div class="relative h-72">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Status</h2>
            <div class="space-y-4">
                <!-- Pending -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Menunggu Ditinjau</span>
                        <span class="text-sm font-bold text-red-600">{{ $pending }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: {{ $totalPengaduan > 0 ? ($pending / $totalPengaduan * 100) : 0 }}%"></div>
                    </div>
                </div>

                <!-- Diproses -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Sedang Diproses</span>
                        <span class="text-sm font-bold text-yellow-600">{{ $diproses }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $totalPengaduan > 0 ? ($diproses / $totalPengaduan * 100) : 0 }}%"></div>
                    </div>
                </div>

                <!-- Selesai -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Selesai Ditangani</span>
                        <span class="text-sm font-bold text-green-600">{{ $selesai }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalPengaduan > 0 ? ($selesai / $totalPengaduan * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                <p class="text-sm text-blue-900">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Total Pengaduan:</strong> {{ $totalPengaduan }} laporan
                </p>
            </div>
        </div>
    </div>

    <!-- Recent Complaints Table -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-900">Pengaduan Terbaru</h2>
            <a href="{{ route('admin.pengaduan.masuk') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Siswa</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Judul Pengaduan</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Tanggal</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-900 text-sm">Status</th>
                        <th class="text-center py-3 px-4 font-semibold text-gray-900 text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($recentPengaduan as $pengaduan)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4">
                            <span class="font-semibold text-gray-900">#{{ str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($pengaduan->user->nama ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm">{{ $pengaduan->user->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $pengaduan->user->username }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-gray-900 font-medium text-sm">{{ Str::limit($pengaduan->judul, 40) }}</p>
                        </td>
                        <td class="py-4 px-4">
                            <p class="text-gray-600 text-sm">{{ $pengaduan->tanggal_lapor->format('d M Y') }}</p>
                        </td>
                        <td class="py-4 px-4">
                            @if ($pengaduan->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                    <span class="w-2 h-2 bg-red-800 rounded-full mr-2"></span>
                                    Pending
                                </span>
                            @elseif ($pengaduan->status === 'diproses')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                    <span class="w-2 h-2 bg-yellow-800 rounded-full mr-2"></span>
                                    Diproses
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                    <span class="w-2 h-2 bg-green-800 rounded-full mr-2"></span>
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button onclick="updateStatus({{ $pengaduan->id }}, '{{ $pengaduan->status }}')" class="text-orange-600 hover:text-orange-700 text-sm font-semibold">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 px-4 text-center text-gray-500">
                            <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                            <p class="mt-2">Tidak ada pengaduan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Update Status -->
<div id="statusModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Update Status Pengaduan</h3>
        </div>
        <form action="" method="POST" id="statusForm">
            @csrf
            @method('POST')
            <div class="p-6">
                <label class="block text-sm font-semibold text-gray-900 mb-3">Pilih Status Baru</label>
                <div class="space-y-3">
                    <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                        <input type="radio" name="status" value="pending" class="w-4 h-4 text-red-600">
                        <span class="ml-3 font-medium text-gray-900">Pending (Menunggu Ditinjau)</span>
                    </label>
                    <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                        <input type="radio" name="status" value="diproses" class="w-4 h-4 text-yellow-600">
                        <span class="ml-3 font-medium text-gray-900">Diproses (Sedang Ditangani)</span>
                    </label>
                    <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition">
                        <input type="radio" name="status" value="selesai" class="w-4 h-4 text-green-600">
                        <span class="ml-3 font-medium text-gray-900">Selesai (Sudah Ditangani)</span>
                    </label>
                </div>
            </div>
            <div class="p-6 bg-gray-50 flex gap-3 justify-end border-t border-gray-100">
                <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Monthly Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pengaduan',
                data: [8, 12, 15, 9, 18, 14, 16, 11, 13, 10, 14, 16],
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5,
                        color: '#6B7280'
                    },
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#6B7280'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });

    // Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Diproses', 'Selesai'],
            datasets: [{
                data: [{{ $pending }}, {{ $diproses }}, {{ $selesai }}],
                backgroundColor: [
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(234, 179, 8, 0.8)',
                    'rgba(34, 197, 94, 0.8)'
                ],
                borderColor: [
                    'rgba(239, 68, 68, 1)',
                    'rgba(234, 179, 8, 1)',
                    'rgba(34, 197, 94, 1)'
                ],
                borderWidth: 2,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 13,
                            weight: 'bold'
                        },
                        color: '#374151'
                    }
                }
            }
        }
    });

    // Activity Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Pengaduan Baru',
                data: [12, 19, 8, 15, 10, 6, 4],
                borderColor: 'rgba(59, 130, 246, 1)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 13,
                            weight: 'bold'
                        },
                        color: '#374151'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#6B7280'
                    },
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#6B7280'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });

    // Modal Functions
    function updateStatus(pengaduanId, currentStatus) {
        const modal = document.getElementById('statusModal');
        const form = document.getElementById('statusForm');
        
        form.action = `/pengaduan/${pengaduanId}/status`;
        document.querySelector(`input[value="${currentStatus}"]`).checked = true;
        
        modal.classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('statusModal').addEventListener('click', (e) => {
        if (e.target.id === 'statusModal') {
            closeStatusModal();
        }
    });
</script>

@endsection
