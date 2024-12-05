<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visi extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ['id', 'name'];
    //protected $with = ['author'];
    protected $fillable = [
        'title_visi',

    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeFilter($query, array $filters)
    {
        if ($filters['searchvisi'] ?? false) {
            $query->where('title_visi', 'like', '%' . request('searchvisi') . '%')
                ->orWhere('title_visi', 'like', '%' . request('searchvisi') . '%');
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static function detail_visi($id)
    {
        $data = Visi::where("id", $id)->first();
        return $data;
    }
}
