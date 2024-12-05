<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukaDukaCita extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ['id', 'name'];
    //protected $with = ['author'];
    protected $fillable = [
        'judul',
        'description',
        'detail',
        'tanggal',
        'category',
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

    static function detail_sukadukacita($id)
    {
        $data = SukaDukaCita::where("id", $id)->first();
        return $data;
    }
}
