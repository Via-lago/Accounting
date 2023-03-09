<?php
namespace App\Http\Controllers;
use App\Http\Requests\CoaRequest;
use App\Http\Requests\DataIndexRequest;
use App\Http\Requests\TransaksiRequest;
use App\Http\Requests\SaldoRequest;
use App\Http\Requests\AkunRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\COA;
use App\Saldo;
use App\DataIndex;
use App\Transaksi;
use App\Akun;
use PDF;
use DB;
use Carbon\Carbon;
class CashflowController extends Controller
{
    public function index()
    {
        $sal = Saldo::orderBy('id','desc')->limit(1)->get();
        $kas = Transaksi::all();
        $month= Carbon::now()->month;
        $year = Carbon::now()->subYear(1)->year;


        $coa =DB::table('coa as c')
        ->join('index as i','c.id_index','=','i.id')
        ->select('c.*','i.id as index')
        ->get();

        $transaksi =DB::table('transaksi')
        ->whereMonth('tanggal_transaksi',Carbon::now()->month)
        ->get();

        $operasional =DB::table('operasional')
        ->whereMonth('tanggal',Carbon::now()->month)
        ->get();

        $hutang =DB::table('hutang')
        ->whereMonth('tanggaltransaksi_hutang',Carbon::now()->month)
        ->get();


        return view('pages.cashflow.index',
        ['coa' => $coa,
        'transaksi'=>$transaksi,
        'operasional'=>$operasional,
        'hutang'=>$hutang,
        'sal' => $sal,
        ]);
    }

    public function store(TransaksiRequest $request)
    {
        return redirect()->back();
    }

    public function cari(Request $request)
    {
        $coa =DB::table('coa as c')
        ->join('index as i','c.id_index','=','i.id')
        ->select('c.*','i.id as index')
        ->get();

        $transaksi =DB::table('transaksi')
        ->where('tanggal_transaksi','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('tanggal_transaksi','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->get();

        $operasional =DB::table('operasional')
        ->where('tanggal','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('tanggal','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->get();

        $hutang =DB::table('hutang')
        ->where('tanggaltransaksi_hutang','>=',$request->cbtahun.'/'.$request->cbperiode.'/01')
        ->where('tanggaltransaksi_hutang','<=', $request->cbtahun.'/'.$request->cbperiode.'/31/')
        ->get();

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

        $kas = Transaksi::all();
        $month= Carbon::now()->month;
        if($request->cbtahun != null){
            $tahun = $request->cbtahun;
        }
        $periode = [1];
        $periode = [2]; 
        $periode = [3];
        $periode = [4];
        $periode = [5]; 
        $periode = [6];
        $periode = [7];
        $periode = [8]; 
        $periode = [9];
        $periode = [10];
        $periode = [11]; 
        $periode= [12];

        return view('pages.cashflow.index_filter',
        ['coa' => $coa,
        'transaksi'=>$transaksi,
        'operasional'=>$operasional,
        'hutang'=>$hutang,
        'sal' => $sal,
        'tahun'=>$tahun,
       ]);

    }
    public function saldo(){

    }

}
