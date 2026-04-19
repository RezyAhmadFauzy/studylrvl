<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Show reports page
     */
    public function index()
    {
        return view('admin.laporan');
    }

    /**
     * Generate monthly report
     */
    public function generateLaporanBulanan(Request $request)
    {
        $bulan = $request->bulan ?? Carbon::now()->month;
        $tahun = $request->tahun ?? Carbon::now()->year;

        $pengaduan = Pengaduan::whereMonth('tanggal_lapor', $bulan)
            ->whereYear('tanggal_lapor', $tahun)
            ->with('user')
            ->orderBy('tanggal_lapor', 'desc')
            ->get();

        $stats = [
            'total' => $pengaduan->count(),
            'pending' => $pengaduan->where('status', 'pending')->count(),
            'diproses' => $pengaduan->where('status', 'diproses')->count(),
            'selesai' => $pengaduan->where('status', 'selesai')->count(),
        ];

        if ($request->ajax() || $request->has('ajax')) {
            return response()->json([
                'pengaduan' => $pengaduan,
                'stats' => $stats,
            ]);
        }

        return view('admin.laporan.bulanan', compact('pengaduan', 'stats', 'bulan', 'tahun'));
    }

    /**
     * Generate yearly report
     */
    public function generateLaporanTahunan(Request $request)
    {
        $tahun = $request->tahun ?? Carbon::now()->year;

        $pengaduan = Pengaduan::whereYear('tanggal_lapor', $tahun)
            ->with('user')
            ->orderBy('tanggal_lapor', 'desc')
            ->get();

        $stats = [
            'total' => $pengaduan->count(),
            'pending' => $pengaduan->where('status', 'pending')->count(),
            'diproses' => $pengaduan->where('status', 'diproses')->count(),
            'selesai' => $pengaduan->where('status', 'selesai')->count(),
        ];

        $chartData = [];
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $count = $pengaduan->filter(function($p) use ($bulan) {
                return $p->tanggal_lapor->month == $bulan;
            })->count();
            $chartData[] = $count;
        }

        if ($request->ajax() || $request->has('ajax')) {
            return response()->json([
                'pengaduan' => $pengaduan,
                'stats' => $stats,
                'chartData' => $chartData,
            ]);
        }

        return view('admin.laporan.tahunan', compact('pengaduan', 'stats', 'chartData', 'tahun'));
    }

    /**
     * Generate status report
     */
    public function generateLaporanStatus(Request $request)
    {
        $periode = $request->periode ?? '1';

        $query = Pengaduan::with('user');

        switch($periode) {
            case '1':
                $query->whereMonth('tanggal_lapor', Carbon::now()->month)
                      ->whereYear('tanggal_lapor', Carbon::now()->year);
                $periodeText = 'Bulan Ini';
                break;
            case '3':
                $query->whereBetween('tanggal_lapor', [
                    Carbon::now()->subMonths(3),
                    Carbon::now()
                ]);
                $periodeText = '3 Bulan Terakhir';
                break;
            case '6':
                $query->whereBetween('tanggal_lapor', [
                    Carbon::now()->subMonths(6),
                    Carbon::now()
                ]);
                $periodeText = '6 Bulan Terakhir';
                break;
            case '12':
                $query->whereYear('tanggal_lapor', Carbon::now()->year);
                $periodeText = '1 Tahun';
                break;
        }

        $pengaduan = $query->orderBy('tanggal_lapor', 'desc')->get();

        $stats = [
            'total' => $pengaduan->count(),
            'pending' => $pengaduan->where('status', 'pending')->count(),
            'diproses' => $pengaduan->where('status', 'diproses')->count(),
            'selesai' => $pengaduan->where('status', 'selesai')->count(),
        ];

        if ($request->ajax() || $request->has('ajax')) {
            return response()->json([
                'pengaduan' => $pengaduan,
                'stats' => $stats,
            ]);
        }

        return view('admin.laporan.status', compact('pengaduan', 'stats', 'periodeText', 'periode'));
    }

    /**
     * Generate student report
     */
    public function generateLaporanSiswa(Request $request)
    {
        $query = \App\Models\User::where('role', 'siswa');

        $urutkan = $request->urutkan ?? 'pengaduan';

        if ($urutkan === 'pengaduan') {
            $siswa = $query->withCount('pengaduan')->orderByDesc('pengaduan_count')->get();
        } elseif ($urutkan === 'nama') {
            $siswa = $query->orderBy('nama')->get();
            $siswa->load('pengaduan');
            // Add pengaduan_count manually
            $siswa->each(function($s) {
                $s->pengaduan_count = $s->pengaduan->count();
            });
        } else {
            $siswa = $query->orderByDesc('created_at')->get();
            $siswa->load('pengaduan');
            // Add pengaduan_count manually
            $siswa->each(function($s) {
                $s->pengaduan_count = $s->pengaduan->count();
            });
        }

        if ($request->ajax() || $request->has('ajax')) {
            return response()->json(['siswa' => $siswa]);
        }

        return view('admin.laporan.siswa', compact('siswa', 'urutkan'));
    }
}

