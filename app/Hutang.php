<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $table = 'hutang';
    protected $guarded = [];
    protected $dates = ['tanggal'];

    public function saldo()
    {
        return $this->belongsTo('App\Saldo');
    }
}
