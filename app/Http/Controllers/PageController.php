<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Saldo;
use Carbon\Carbon;


class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function beranda()
    {
        $trans = Transaksi::all();
        $saldo = Saldo::orderBy('id','desc')->limit(1)->get();
        $tanggal = Carbon::now()->isoFormat('MMMM YYYY');
    
        return view('pages.beranda', [
             'saldo' => $saldo,
             'tanggal' => $tanggal,
            ]
        );
    }

}
