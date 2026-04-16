<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'id_user',
        'judul',
        'isi_laporan',
        'foto',
        'status',
        'tanggal_lapor',
    ];

    protected $casts = [
        'tanggal_lapor' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Scope untuk mendapatkan pengaduan user tertentu
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('id_user', $userId);
    }

    /**
     * Scope untuk mendapatkan pengaduan dengan status tertentu
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Helper untuk badge status
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-danger"><i class="fas fa-hourglass-start"></i> Pending</span>',
            'diproses' => '<span class="badge bg-warning"><i class="fas fa-spinner"></i> Diproses</span>',
            'selesai' => '<span class="badge bg-success"><i class="fas fa-check-circle"></i> Selesai</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    /**
     * Helper untuk warna status chart
     */
    public static function getStatusColor($status)
    {
        $colors = [
            'pending' => '#dc3545',
            'diproses' => '#ffc107',
            'selesai' => '#28a745',
        ];

        return $colors[$status] ?? '#6c757d';
    }
}
