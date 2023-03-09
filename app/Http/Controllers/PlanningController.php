<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\TransaksiRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\SaldoRequest;
use App\Http\Requests\AkunRequest;
use App\Http\Requests\CoaRequest;
use App\Http\Requests\OperasionalRequest;
use App\Transaksi;
use App\COA;
use App\DataIndex;
use App\Akun;
use App\User;
use App\Saldo;
use App\Butuh;
use App\Target;
use App\Operasional;
use DB;
use Carbon\Carbon;

class PlanningController extends Controller
{
    public function index()
    {
        $sal = Saldo::orderBy('id','desc')->limit(1)->get();
        $butuh = Butuh::orderBy('id','desc')->limit(1)->get();
        $coa  = COA::all();
        $target = Target::all();
        $operasional = Operasional::all();
        
        $hutang =DB::table('hutang as h')
        ->join ('coa as c','h.id_coa','=','c.id')
        ->whereMonth('h.jatuhtempo_hutang',Carbon::now()->month)
        ->get();

        $operasional =DB::table('operasional as o')
        ->join ('coa as c','o.id_coa','=','c.id')
        ->whereMonth('o.tanggal',Carbon::now()->subMonth()->month)
        ->get();

        $biayaoperasional =0;
        $totalhutang=0;
        $totaloperasional=0;
        $totalpengeluaran = 0;
        foreach($hutang as $h){
            $totalhutang= $totalhutang+$h->jumlah;
        }
        foreach($operasional as $o){
            $totaloperasional= $totaloperasional+$o->jumlah;
        }
        $totalpengeluaran = $totaloperasional+$totalhutang;

        $selisih= 0;
        foreach($target as $t){
            $selisih = $t->jumlah - $totalpengeluaran;
        }
        $saldo_sekarang =0;
        foreach($sal as $s){
            $saldo_sekarang = $selisih + $s->total;
        }

        $saldo_akhir =0;
        foreach($butuh as $b){
            $saldo_akhir = $saldo_sekarang - $b->Jumlah;
        }
        
        $month= Carbon::now()->month;
        $year = Carbon::now()->subYear(1)->year;

        return view('pages.planning.index',[
            'coa' => $coa,
            'sal' => $sal,
            'butuh'=>$butuh,
            'target'=>$target,
            'hutang'=>$hutang,
            'operasional'=>$operasional,
            'totalpengeluaran'=>$totalpengeluaran,
            'selisih'=>$selisih,
            'saldo_sekarang'=>$saldo_sekarang,
            'saldo_akhir'=>$saldo_akhir,
        ]);
    }

    public function createPlanning()
    {
        $butuh  = Butuh::all();
        return view('pages.planning.create',['butuh' => $butuh]);
    }

    public function store(SaldoRequest $request)
    {
        Butuh::create($request->all());
        return redirect()->back()->with('pesan', "Input data {$request->saldo_butuh} sukses");
    }

    public function cari(Request $request)
    {
        $saltransaksi = DB:: table('saldo as s')
        ->join('transaksi as t','t.saldo_id','=','s.id')
        ->where('t.tanggal_transaksi','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('t.tanggal_transaksi','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->orderBy('s.id','desc')
        ->limit(1)
        ->get();

        $saloperasional = DB:: table('saldo as s')
        ->join('operasional as o','o.saldo_id','=','s.id')
        ->where('o.tanggal','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('o.tanggal','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->orderBy('o.id','desc')
        ->limit(1)
        ->get();

        $salhutang = DB:: table('saldo as s')
        ->join('hutang as h','h.saldo_id','=','s.id')
        ->where('h.jatuhtempo_hutang','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('h.jatuhtempo_hutang','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->orderBy('s.id','desc')
        ->limit(1)
        ->get();

        $tanggaltransaksi=0;
        $tanggaloperasional=0;   
        $tanggalhutang=0;
        $sal=0;

        foreach($saltransaksi as $s){
            $tanggaltransaksi=$s->tanggal_transaksi;
        }
        foreach($saloperasional as $s){
            $tanggaloperasional=$s->tanggal;
        }
        foreach($salhutang as $s){
            $tanggalhutang=$s->jatuhtempo_hutang;
        }

        if($tanggaltransaksi>$tanggaloperasional&&$tanggaltransaksi>$tanggalhutang){
            $sal=$saltransaksi;
        }elseif ($tanggaloperasional>$tanggaltransaksi&&$tanggaloperasional>$tanggalhutang) {
            $sal=$saloperasional;
        }else{
            $sal=$salhutang;
        }


        $butuh = Butuh::orderBy('id','desc')->limit(1)->get();
        $coa  = COA::all();
        $target = Target::all();
        $operasional = Operasional::all();
        
        $hutang =DB::table('hutang as h')
        ->join ('coa as c','h.id_coa','=','c.id')
        ->where('jatuhtempo_hutang','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('jatuhtempo_hutang','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->where('status','Belum Bayar')
        ->get();

        $operasional =DB::table('operasional as o')
        ->join ('coa as c','o.id_coa','=','c.id')
        ->where('tanggal','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('tanggal','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->get();

        $biayaoperasional =0;
        $totalhutang=0;
        $totaloperasional=0;
        $totalpengeluaran = 0;
        foreach($hutang as $h){
            $totalhutang= $totalhutang+$h->jumlah;
        }
        foreach($operasional as $o){
            $totaloperasional= $totaloperasional+$o->jumlah;
        }
        $totalpengeluaran = $totaloperasional+$totalhutang;

        $selisih= 0;
        foreach($target as $t){
            $selisih = $t->jumlah - $totalpengeluaran;
        }
        $saldo_sekarang =0;
        foreach($sal as $s){
            $saldo_sekarang = $selisih + $s->total;
        }

        $saldo_akhir =0;
        foreach($butuh as $b){
            $saldo_akhir = $saldo_sekarang - $b->Jumlah;
        }
        
        $month= Carbon::now()->month;
        if($request->cbtahun != null){
            $tahun = $request->cbtahun;
        }
        return view('pages.planning.index_filter',[
            'coa' => $coa,
            'sal' => $sal,
            'butuh'=>$butuh,
            'target'=>$target,
            'hutang'=>$hutang,
            'operasional'=>$operasional,
            'totalpengeluaran'=>$totalpengeluaran,
            'selisih'=>$selisih,
            'saldo_sekarang'=>$saldo_sekarang,
            'saldo_akhir'=>$saldo_akhir,
        ]);

    }
}
