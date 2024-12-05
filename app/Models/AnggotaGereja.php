<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaGereja extends Model
{
    use HasFactory;

    protected $fillable = [
        'keluarga', 'no_kk', 'nama', 'user_id',
    ];

    // Jika perlu, Anda bisa menambahkan relasi ke model User jika ingin menampilkan nama pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
