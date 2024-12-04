<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'location',
        'about_me',
        'domain',
        'google_map'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function organisasiGereja()
    {
        return $this->hasMany(OrganisasiGereja::class, 'user_id');
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->ayatHarians()->delete();
            $user->events()->delete();
            $user->wartaJemaats()->delete();
            $user->organisasiGereja()->delete();
            $user->sukaDukaCitas()->delete();
        });
    }

    public function ayatHarians()
    {
        return $this->hasMany(AyatHarian::class, 'user_id');
    }

    // public function organisasiGereja()
    // {
    //     return $this->hasOne(OrganisasiGereja::class, 'user_id');
    // }

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    public function wartaJemaats()
    {
        return $this->hasMany(WartaJemaat::class, 'user_id');
    }
    public function sukaDukaCitas()
    {
        return $this->hasMany(SukaDukaCita::class, 'user_id');
    }
    public function sejarah()
    {
        return $this->hasOne(Sejarah::class, 'user_id', 'id');
    }
    public function visi()
    {
        return $this->hasMany(Visi::class);
    }

    public function misi()
    {
        return $this->hasMany(Misi::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

}
