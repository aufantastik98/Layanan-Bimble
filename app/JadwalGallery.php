<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalGallery extends Model
{
   protected $fillable = [
        'fotos', 'jadwals_id'
    ];

    protected $hidden = [

    ];

    public function jadwal(){
        return $this->belongsTo(Jadwal::class, 'jadwals_id', 'id');
    }
}
