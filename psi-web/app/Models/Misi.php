<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ['id', 'name'];
    //protected $with = ['author'];
    protected $fillable = [
        'title_misi',

    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title_misi', 'like', '%' . request('search') . '%')
                ->orWhere('title_misi', 'like', '%' . request('search') . '%');
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static function detail_misi($id)
    {
        $data = Misi::where("id", $id)->first();
        return $data;
    }
}
