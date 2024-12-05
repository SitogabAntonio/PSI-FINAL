<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'roleId', 'roleName',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('roleName', 'like', '%' . $search . '%')
                ->orWhere('roleId', 'like', '%' . $search . '%');
        });
    }
}
