<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'jadwals_id', 'users_id'
    ];

    protected $hidden = [

    ];

    public function jadwal(){
        return $this->hasOne( Jadwal::class, 'id', 'jadwals_id' );
    }

    public function user(){
        return $this->belongsTo( User::class, 'users_id', 'id');
    }
}
