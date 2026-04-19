<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display list of all students with recent login info
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'siswa');

        // Filter by search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by kelas
        if ($request->kelas) {
            $query->where('kelas', $request->kelas);
        }

        // Sort
        $sortBy = $request->sort_by ?? 'updated_at';
        $sortOrder = $request->sort_order ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        $siswa = $query->paginate(15);

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Store new student
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255',
            'nis' => 'required|string|unique:users,nis',
            'kelas' => 'required|in:10,11,12',
            'username' => 'required|string|min:4|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama' => $validated['nama'],
            'nis' => $validated['nis'],
            'kelas' => $validated['kelas'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'siswa',
        ]);

        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Show edit form
     */
    public function edit(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update student
     */
    public function update(Request $request, User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }

        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255',
            'nis' => 'required|string|unique:users,nis,' . $siswa->id,
            'kelas' => 'required|in:10,11,12',
            'username' => 'required|string|min:4|unique:users,username,' . $siswa->id,
            'email' => 'required|email|unique:users,email,' . $siswa->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $siswa->update([
            'nama' => $validated['nama'],
            'nis' => $validated['nis'],
            'kelas' => $validated['kelas'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ]);

        if ($validated['password']) {
            $siswa->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil diperbarui');
    }

    /**
     * Delete student
     */
    public function destroy(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            abort(404);
        }

        $siswa->delete();
        return redirect()->route('admin.siswa')->with('success', 'Siswa berhasil dihapus');
    }
}
