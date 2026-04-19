<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Display student dashboard with statistics
     */
    public function studentDashboard()
    {
        $user = Auth::user();
        
        // Get user's complaint statistics
        $totalPengaduan = Pengaduan::byUser($user->id)->count();
        $diproses = Pengaduan::byUser($user->id)->withStatus('diproses')->count();
        $selesai = Pengaduan::byUser($user->id)->withStatus('selesai')->count();
        $pending = Pengaduan::byUser($user->id)->withStatus('pending')->count();

        // Get recent complaints
        $recentPengaduan = Pengaduan::byUser($user->id)
            ->latest('tanggal_lapor')
            ->take(5)
            ->get();

        // Get chart data
        $statusData = [
            'pending' => $pending,
            'diproses' => $diproses,
            'selesai' => $selesai,
        ];

        return view('student.dashboard', compact(
            'totalPengaduan',
            'diproses',
            'selesai',
            'pending',
            'recentPengaduan',
            'statusData'
        ));
    }

    /**
     * Show form to create new complaint
     */
    public function create()
    {
        return view('student.buat-pengaduan');
    }

    /**
     * Store new complaint
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string|min:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul pengaduan wajib diisi',
            'judul.max' => 'Judul maksimal 255 karakter',
            'isi_laporan.required' => 'Isi laporan wajib diisi',
            'isi_laporan.min' => 'Isi laporan minimal 10 karakter',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'pengaduan_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pengaduan'), $filename);
            $validated['foto'] = $filename;
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['tanggal_lapor'] = now();

        Pengaduan::create($validated);

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Pengaduan berhasil dibuat! Tim kami akan meninjau dalam waktu singkat.');
    }

    /**
     * Show complaint history
     */
    public function history()
    {
        $pengaduan = Pengaduan::byUser(Auth::id())
            ->latest('tanggal_lapor')
            ->paginate(10);

        return view('student.riwayat-pengaduan', compact('pengaduan'));
    }

    /**
     * Show complaint detail
     */
    public function show(Pengaduan $pengaduan)
    {
        // Check if user owns this complaint
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('student.detail-pengaduan', compact('pengaduan'));
    }

    /**
     * Admin: Get all complaints
     */
    public function adminDashboard()
    {
        $totalPengaduan = Pengaduan::count();
        $diproses = Pengaduan::withStatus('diproses')->count();
        $selesai = Pengaduan::withStatus('selesai')->count();
        $pending = Pengaduan::withStatus('pending')->count();

        $recentPengaduan = Pengaduan::with('user')
            ->latest('tanggal_lapor')
            ->take(10)
            ->get();

        $statusData = [
            'pending' => $pending,
            'diproses' => $diproses,
            'selesai' => $selesai,
        ];

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'diproses',
            'selesai',
            'pending',
            'recentPengaduan',
            'statusData'
        ));
    }

    /**
     * Admin: Update complaint status
     */
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'catatan' => $request->catatan ?? $pengaduan->catatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status pengaduan berhasil diperbarui',
            'data' => [
                'id' => $pengaduan->id,
                'status' => $pengaduan->status,
            ]
        ]);
    }

    /**
     * Admin: Delete complaint
     */
    public function destroy(Pengaduan $pengaduan)
    {
        // Delete attached file if exists
        if ($pengaduan->foto && file_exists(public_path('uploads/pengaduan/' . $pengaduan->foto))) {
            unlink(public_path('uploads/pengaduan/' . $pengaduan->foto));
        }

        $pengaduan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan berhasil dihapus'
        ]);
    }

    /**
     * Get pengaduan detail as JSON (for AJAX)
     */
    public function getDetail(Pengaduan $pengaduan)
    {
        return response()->json([
            'pengaduan' => [
                'id' => $pengaduan->id,
                'judul' => $pengaduan->judul,
                'isi_laporan' => $pengaduan->isi_laporan,
                'foto' => $pengaduan->foto,
                'status' => $pengaduan->status,
                'catatan' => $pengaduan->catatan ?? '',
                'tanggal_lapor' => $pengaduan->tanggal_lapor,
                'user' => [
                    'id' => $pengaduan->user->id,
                    'nama' => $pengaduan->user->nama,
                    'username' => $pengaduan->user->username,
                    'email' => $pengaduan->user->email,
                    'nis' => $pengaduan->user->nis,
                    'kelas' => $pengaduan->user->kelas,
                ],
            ],
        ]);
    }
}
