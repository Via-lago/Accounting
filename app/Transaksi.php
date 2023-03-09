<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = [];
    protected $dates = ['tanggal'];

    public function saldo()
    {
        return $this->belongsTo('App\Saldo');
    }
}
