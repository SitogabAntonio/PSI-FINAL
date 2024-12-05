<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'details',
        'nominal',
        'tanggal',
        'kategori',
    ];

    protected $dateFormat = 'Y-m-d';

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('tanggal', 'like', '%' . request('search') . '%')
                ->orWhere('header', 'like', '%' . request('search') . '%')
                ->orWhere('nominal', 'like', '%' . request('search') . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
