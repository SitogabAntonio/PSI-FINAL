<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ['id', 'name'];
    //protected $with = ['author'];
    protected $fillable = [
        'event_name',
        'event_description',
        'event_location',
        'event_start_date',
        'event_end_date',
        'event_image'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('event_name', 'like', '%' . request('search') . '%')
                ->orWhere('event_location', 'like', '%' . request('search') . '%');
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    static function detail_event($id)
    {
        $data = Event::where("id", $id)->first();
        return $data;
    }
}
