<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Admin/Officer Dashboard
    Route::get('/dashboard', function () {
        $pending = \App\Models\Pengaduan::where('status', 'pending')->count();
        $diproses = \App\Models\Pengaduan::where('status', 'diproses')->count();
        $selesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
        $totalPengaduan = \App\Models\Pengaduan::count();
        $recentPengaduan = \App\Models\Pengaduan::with('user')->latest('tanggal_lapor')->take(10)->get();
        $statusData = [
            'pending' => $pending,
            'diproses' => $diproses,
            'selesai' => $selesai,
        ];
        return view('admin.dashboard', compact('totalPengaduan', 'diproses', 'selesai', 'pending', 'recentPengaduan', 'statusData'));
    })->name('dashboard');
    
    Route::post('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');

    // Admin Routes
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/siswa', function () {
            return view('admin.siswa');
        })->name('siswa');

        Route::prefix('/pengaduan')->name('pengaduan.')->group(function () {
            Route::get('/masuk', function () {
                $pengaduan = \App\Models\Pengaduan::with('user')->where('status', 'pending')->paginate(10);
                $pending = \App\Models\Pengaduan::where('status', 'pending')->count();
                $diproses = \App\Models\Pengaduan::where('status', 'diproses')->count();
                $selesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
                return view('admin.pengaduan.masuk', compact('pengaduan', 'pending', 'diproses', 'selesai'));
            })->name('masuk');

            Route::get('/diproses', function () {
                $pengaduan = \App\Models\Pengaduan::with('user')->where('status', 'diproses')->paginate(10);
                $pending = \App\Models\Pengaduan::where('status', 'pending')->count();
                $diproses = \App\Models\Pengaduan::where('status', 'diproses')->count();
                $selesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
                return view('admin.pengaduan.diproses', compact('pengaduan', 'pending', 'diproses', 'selesai'));
            })->name('diproses');

            Route::get('/selesai', function () {
                $pengaduan = \App\Models\Pengaduan::with('user')->where('status', 'selesai')->paginate(10);
                $pending = \App\Models\Pengaduan::where('status', 'pending')->count();
                $diproses = \App\Models\Pengaduan::where('status', 'diproses')->count();
                $selesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
                return view('admin.pengaduan.selesai', compact('pengaduan', 'pending', 'diproses', 'selesai'));
            })->name('selesai');
        });

        Route::get('/laporan', function () {
            return view('admin.laporan');
        })->name('laporan');

        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');
    });

    // Student/User Routes
    Route::prefix('/student')->name('student.')->group(function () {
        Route::get('/dashboard', [PengaduanController::class, 'studentDashboard'])->name('dashboard');
        Route::get('/buat-pengaduan', [PengaduanController::class, 'create'])->name('create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('store');
        Route::get('/riwayat', [PengaduanController::class, 'history'])->name('history');
        Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('show');
    });
});

