<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailWartaJemaat extends Model
{
    use HasFactory;
    
    protected $table = 'detail_wartas';

    protected $fillable = ['warta_jemaat_id', 'header', 'isi'];

    public function wartaJemaat()
    {
        return $this->belongsTo(WartaJemaat::class);
    }
}
