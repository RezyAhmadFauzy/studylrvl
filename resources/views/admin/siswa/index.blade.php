@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Data Siswa</h1>
                <p class="text-gray-600 mt-2">Kelola data siswa yang telah terdaftar di sistem</p>
            </div>
            <a href="{{ route('admin.siswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center gap-2 transition">
                <i class="fas fa-plus"></i> Tambah Siswa
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-lg flex items-center gap-3">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-lg flex items-center gap-3">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" class="flex gap-4 flex-wrap items-end">
                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Siswa</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, Username, Email, NIS..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Kelas Filter -->
                <div class="w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <select name="kelas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kelas</option>
                        <option value="10" {{ request('kelas') == '10' ? 'selected' : '' }}>Kelas 10</option>
                        <option value="11" {{ request('kelas') == '11' ? 'selected' : '' }}>Kelas 11</option>
                        <option value="12" {{ request('kelas') == '12' ? 'selected' : '' }}>Kelas 12</option>
                    </select>
                </div>

                <!-- Sort -->
                <div class="w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                    <select name="sort_by" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="updated_at" {{ request('sort_by') == 'updated_at' ? 'selected' : '' }}>Terbaru</option>
                        <option value="nama" {{ request('sort_by') == 'nama' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nis" {{ request('sort_by') == 'nis' ? 'selected' : '' }}>NIS</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition flex items-center gap-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.siswa.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-600">
                <p class="text-gray-600 text-sm font-semibold">Total Siswa</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ \App\Models\User::where('role', 'siswa')->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-600">
                <p class="text-gray-600 text-sm font-semibold">Kelas 10</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ \App\Models\User::where('role', 'siswa')->where('kelas', 10)->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-600">
                <p class="text-gray-600 text-sm font-semibold">Kelas 11</p>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ \App\Models\User::where('role', 'siswa')->where('kelas', 11)->count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-600">
                <p class="text-gray-600 text-sm font-semibold">Kelas 12</p>
                <p class="text-3xl font-bold text-purple-600 mt-2">{{ \App\Models\User::where('role', 'siswa')->where('kelas', 12)->count() }}</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-200 border-b border-gray-300">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Username</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">NIS</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kelas</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Pengaduan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $student)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $siswa->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $student->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->username }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->nis ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $student->kelas ? 'Kelas ' . $student->kelas : '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $student->pengaduan()->count() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                <a href="{{ route('admin.siswa.edit', $student->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-xs font-semibold transition" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="openDeleteModal({{ $student->id }}, '{{ $student->nama }}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-xs font-semibold transition" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4 opacity-50"></i>
                                <p class="text-lg font-semibold">Tidak ada data siswa</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white border-t border-gray-200 px-6 py-4">
                {{ $siswa->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
            <i class="fas fa-exclamation text-red-600 text-2xl"></i>
        </div>
        <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Hapus Siswa?</h3>
        <p class="text-center text-gray-600 mb-6">Apakah Anda yakin ingin menghapus <span id="studentName" class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-lg font-semibold transition">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .pagination {
        display: flex;
        gap: 0.25rem;
        justify-content: center;
    }

    .pagination a, .pagination span {
        px: 0.75rem;
        py: 0.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
    }

    .pagination a:hover {
        background-color: #f3f4f6;
    }

    .pagination .active {
        background-color: #2563eb;
        color: white;
        border-color: #2563eb;
    }
</style>

<script>
function openDeleteModal(id, name) {
    document.getElementById('studentName').textContent = name;
    document.getElementById('deleteForm').action = `/admin/siswa/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection
