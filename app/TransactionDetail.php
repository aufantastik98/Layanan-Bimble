<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transactions_id', 
        'jadwals_id',
        'price',
        'shipping_status',
        'resi',
        'code'
    ];

    protected $hidden = [

    ];

    public function jadwal(){
        return $this->hasOne( Jadwal::class, 'id', 'jadwals_id' );
    }

    public function transaction(){
        return $this->hasOne( Transaction::class, 'id', 'transactions_id' );
    }

}
