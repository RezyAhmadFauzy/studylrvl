<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255',
            'nis' => 'required|string|unique:users,nis|regex:/^\d+$/',
            'kelas' => 'required|string|in:10,11,12',
            'username' => 'required|string|min:4|unique:users,username|regex:/^[a-zA-Z0-9_-]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'agree' => 'accepted',
        ], [
            'nama.required' => 'Nama lengkap tidak boleh kosong.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'nis.required' => 'NIS tidak boleh kosong.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nis.regex' => 'NIS hanya boleh berisi angka.',
            'kelas.required' => 'Kelas harus dipilih.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.min' => 'Username minimal 4 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'username.regex' => 'Username hanya boleh mengandung huruf, angka, underscore, dan dash.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'agree.accepted' => 'Anda harus menerima syarat & ketentuan.',
        ]);

        // Create new user
        $user = User::create([
            'nama' => $validated['nama'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'nis' => $validated['nis'],
            'kelas' => $validated['kelas'],
            'role' => 'siswa',
        ]);

        // Auto-login after registration
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('student.dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->nama . '.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->onlyInput('username');
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
