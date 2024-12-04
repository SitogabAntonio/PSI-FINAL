<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WartaJemaat extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'judul',
        'tanggal',
        'penkotbah',
        'judul_renungan',
        'isi_renungan',
        'user_id',
        'deskripsi_pengumuman'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('judul', 'like', '%' . request('search') . '%')
                ->orWhere('tanggal', 'like', '%' . request('search') . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailWartas()
    {
        return $this->hasMany(DetailWartaJemaat::class, 'warta_jemaat_id');
    }

    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'user_id');
    }
}