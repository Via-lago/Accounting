<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    protected $table = 'piutang';
    protected $guarded = [];
    protected $dates = ['tanggal'];

    public function saldo()
    {
        return $this->belongsTo('App\Saldo');
    }
}
