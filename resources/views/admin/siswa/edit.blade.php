@extends('layouts.admin')

@section('title', 'Edit Siswa')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.siswa.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2 mb-4">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Edit Data Siswa</h1>
            <p class="text-gray-600 mt-2">Perbarui data siswa <strong>{{ $siswa->nama }}</strong></p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form method="POST" action="{{ route('admin.siswa.update', $siswa->id) }}">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required value="{{ old('nama', $siswa->nama) }}"
                           class="w-full px-4 py-3 border @error('nama') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Contoh: Muhammad Ridho Pratama">
                    @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIS -->
                <div class="mb-6">
                    <label for="nis" class="block text-sm font-semibold text-gray-700 mb-2">NIS (Nomor Induk Siswa)</label>
                    <input type="text" id="nis" name="nis" required value="{{ old('nis', $siswa->nis) }}"
                           class="w-full px-4 py-3 border @error('nis') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Contoh: 1234567890">
                    @error('nis')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas -->
                <div class="mb-6">
                    <label for="kelas" class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
                    <select id="kelas" name="kelas" required
                            class="w-full px-4 py-3 border @error('kelas') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">-- Pilih Kelas --</option>
                        <option value="10" {{ old('kelas', $siswa->kelas) == '10' ? 'selected' : '' }}>Kelas 10</option>
                        <option value="11" {{ old('kelas', $siswa->kelas) == '11' ? 'selected' : '' }}>Kelas 11</option>
                        <option value="12" {{ old('kelas', $siswa->kelas) == '12' ? 'selected' : '' }}>Kelas 12</option>
                    </select>
                    @error('kelas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-6">
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" required value="{{ old('username', $siswa->username) }}"
                           class="w-full px-4 py-3 border @error('username') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Contoh: ridho_pratama">
                    <p class="text-gray-500 text-sm mt-1">Minimal 4 karakter, hanya alfanumerik, underscore, dan dash</p>
                    @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required value="{{ old('email', $siswa->email) }}"
                           class="w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Contoh: ridho@example.com">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password (Optional for edit) -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password (Kosongkan jika tidak ingin diubah)</label>
                    <input type="password" id="password" name="password"
                           class="w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Minimal 8 karakter">
                    <p class="text-gray-500 text-sm mt-1">Minimal 8 karakter untuk keamanan maksimal</p>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full px-4 py-3 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                           placeholder="Ulang password di atas">
                    @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg mb-8">
                    <i class="fas fa-info-circle"></i>
                    <span class="ml-2">Data terakhir diubah: {{ $siswa->updated_at->format('d M Y H:i') }}</span>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.siswa.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 px-6 py-3 rounded-lg font-semibold transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
