@extends('layouts.admin')

@section('title', 'Pengaduan Selesai')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Pengaduan Selesai</h1>
            <p class="text-gray-600 mt-2">Daftar pengaduan yang sudah ditangani ({{ $pengaduan->total() ?? 0 }} pengaduan)</p>
        </div>
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2">
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
                <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Complaints List -->
    <div class="space-y-4">
        @forelse ($pengaduan as $item)
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow border-l-4 border-green-500">
            <div class="flex gap-6">
                <!-- Status Indicator -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center text-green-600 text-2xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">ID: #{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                            <h3 class="text-xl font-bold text-gray-900">{{ $item->judul }}</h3>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                            <span class="w-2 h-2 bg-green-800 rounded-full mr-2"></span>
                            Selesai
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
                        <span>
                            <i class="fas fa-check-double mr-2 text-green-600"></i>
                            Selesai {{ $item->updated_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="viewDetail({{ $item->id }})" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition text-sm">
                            <i class="fas fa-eye mr-2"></i> Lihat Detail
                        </button>
                        <button class="px-4 py-2 border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-lg font-semibold transition text-sm">
                            <i class="fas fa-print mr-2"></i> Cetak Laporan
                        </button>
                        <button class="px-4 py-2 border border-red-200 hover:bg-red-50 text-red-600 rounded-lg font-semibold transition text-sm">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <i class="fas fa-check-circle text-4xl text-gray-300 mb-4 opacity-50"></i>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Tidak Ada Pengaduan Selesai</h3>
            <p class="text-gray-600">Belum ada pengaduan yang ditandai selesai</p>
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
        document.getElementById('detailContent').innerHTML = `
            <div class="space-y-4">
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-sm font-semibold text-green-900">✓ Pengaduan telah selesai ditangani</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600 font-semibold">Hasil Penanganan</label>
                    <p class="text-gray-700 mt-2">Pihak sekolah telah mengirimkan AC untuk ruang kelas X-A. AC sudah terpasang dan dalam kondisi baik. Ruang kelas kini lebih nyaman.</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600 font-semibold">Tanggal Selesai</label>
                    <p class="text-gray-900 font-semibold mt-2">15 Januari 2026</p>
                </div>
            </div>
        `;
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    document.getElementById('detailModal').addEventListener('click', (e) => {
        if (e.target.id === 'detailModal') {
            closeDetailModal();
        }
    });
</script>

@endsection
