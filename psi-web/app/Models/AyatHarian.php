<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyatHarian extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ['id', 'name'];
    //protected $with = ['author'];
    protected $fillable = [
        'tema',
        'ayat',
        'isi_ayat',
        'detail',
        'tanggal'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('tema', 'like', '%' . request('search') . '%')
                ->orWhere('tema', 'like', '%' . request('search') . '%');
        }
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    static function detail_ayatharian($id)
    {
        $data = AyatHarian::where("id", $id)->first();
        // $data = Produk::find($id);
        return $data;
    }
}
