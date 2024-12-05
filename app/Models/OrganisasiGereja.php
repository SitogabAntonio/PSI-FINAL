<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiGereja extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'organisasi_gerejas';
    protected $guarded = ['id', 'name'];
    //protected $with = ['author'];
    protected $fillable = [
        'jabatan',
        'nama',
        'foto',
        'user_id'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    // public function scopeFilter($query, array $filters)
    // {
    //     if ($filters['search'] ?? false) {
    //         $query->where('pendeta', 'like', '%' . request('search') . '%')
    //             ->orWhere('guru_huria', 'like', '%' . request('search') . '%');
    //     }
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static function detail_organisasigereja($id)
    {
        $data = OrganisasiGereja::where("id", $id)->first();
        // $data = Produk::find($id);
        return $data;
    }
}
