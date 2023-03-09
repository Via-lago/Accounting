<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operasional extends Model
{
    protected $table = 'operasional';
    protected $guarded = [];
    protected $dates = ['tanggal'];

    public function saldo()
    {
        return $this->belongsTo('App\Saldo');
    }
}
