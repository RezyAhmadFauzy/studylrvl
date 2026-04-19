@extends('layouts.admin')

@section('title', 'Pengaduan Masuk')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Pengaduan Masuk</h1>
            <p class="text-gray-600 mt-2">Daftar pengaduan baru yang butuh ditinjau ({{ $pengaduan->total() ?? 0 }} pengaduan)</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-lg shadow-sm p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <input type="text" placeholder="Cari pengaduan..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <select class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Terbaru</option>
                    <option>Terlama</option>
                    <option>Nama A-Z</option>
                </select>
            </div>
            <div>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Complaints List -->
    <div class="space-y-4">
        @forelse ($pengaduan as $item)
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex gap-6">
                <!-- Status Indicator -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center text-red-600 text-2xl">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">ID: #{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                            <h3 class="text-xl font-bold text-gray-900">{{ $item->judul }}</h3>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                            <span class="w-2 h-2 bg-red-800 rounded-full mr-2"></span>
                            Pending
                        </span>
                    </div>

                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($item->isi_laporan, 200) }}</p>

                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                        <span>
                            <i class="fas fa-user mr-2 text-gray-400"></i>
                            <strong>{{ $item->user->nama }}</strong> ({{ $item->user->username }})
                        </span>
                        <span>
                            <i class="fas fa-calendar mr-2 text-gray-400"></i>
                            {{ $item->tanggal_lapor->format('d M Y, H:i') }}
                        </span>
                        @if ($item->foto)
                        <span>
                            <i class="fas fa-image mr-2 text-gray-400"></i>
                            Dengan lampiran
                        </span>
                        @endif
                    </div>

                    <div class="flex gap-3">
                        <button onclick="viewDetail({{ $item->id }})" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition text-sm">
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        </button>
                        <button onclick="updateStatusBtn({{ $item->id }})" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-semibold transition text-sm">
                            <i class="fas fa-spinner mr-2"></i> Ubah ke Diproses
                        </button>
                        <button class="px-4 py-2 border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-lg font-semibold transition text-sm">
                            <i class="fas fa-print mr-2"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Tidak Ada Pengaduan Masuk</h3>
            <p class="text-gray-600">Semua pengaduan baru sudah ditinjau</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($pengaduan->hasPages())
    <div class="flex items-center justify-between pt-6">
        <p class="text-sm text-gray-600">Menampilkan {{ $pengaduan->firstItem() }}-{{ $pengaduan->lastItem() }} dari {{ $pengaduan->total() }} pengaduan</p>
        <div class="flex gap-2">
            {{ $pengaduan->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Detail Modal -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-96 overflow-y-auto">
        <div class="p-6 border-b border-gray-100 sticky top-0 bg-white">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Detail Pengaduan</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <div id="detailContent" class="p-6">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
    function viewDetail(id) {
        document.getElementById('detailModal').classList.remove('hidden');
        
        // Fetch pengaduan detail from server
        fetch(`/api/pengaduan/${id}`)
            .then(response => response.json())
            .then(data => {
                const pengaduan = data.pengaduan;
                const fotoHtml = pengaduan.foto ? `
                    <div>
                        <label class="text-sm text-gray-600 font-semibold">Foto Lampiran</label>
                        <div class="mt-2">
                            <img src="/uploads/pengaduan/${pengaduan.foto}" alt="Foto" class="max-w-xs rounded-lg">
                        </div>
                    </div>
                ` : '';

                document.getElementById('detailContent').innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">ID Pengaduan</label>
                            <p class="text-gray-900 font-monospace">#${String(pengaduan.id).padStart(5, '0')}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Judul Pengaduan</label>
                            <p class="text-gray-900 font-semibold">${pengaduan.judul}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Isi Laporan</label>
                            <p class="text-gray-700">${pengaduan.isi_laporan}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Dari Siswa</label>
                            <p class="text-gray-900"><strong>${pengaduan.user.nama}</strong> (${pengaduan.user.username})</p>
                            <p class="text-sm text-gray-600">NIS: ${pengaduan.user.nis} - Kelas: ${pengaduan.user.kelas}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Email Siswa</label>
                            <p class="text-gray-900">${pengaduan.user.email}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Tanggal Laporan</label>
                            <p class="text-gray-900">${new Date(pengaduan.tanggal_lapor).toLocaleString('id-ID')}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 font-semibold">Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 mt-1">
                                <span class="w-2 h-2 bg-red-800 rounded-full mr-2"></span>
                                ${pengaduan.status.charAt(0).toUpperCase() + pengaduan.status.slice(1)}
                            </span>
                        </div>
                        ${fotoHtml}
                    </div>
                `;
            })
            .catch(error => {
                document.getElementById('detailContent').innerHTML = `
                    <div class="text-center text-red-600">
                        <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                        <p>Gagal memuat detail pengaduan</p>
                    </div>
                `;
                console.error('Error:', error);
            });
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function updateStatusBtn(id) {
        // Update status ke diproses
        alert('Pengaduan akan diubah ke status Diproses');
    }

    document.getElementById('detailModal').addEventListener('click', (e) => {
        if (e.target.id === 'detailModal') {
            closeDetailModal();
        }
    });
</script>

@endsection
