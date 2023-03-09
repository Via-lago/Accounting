<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HutangRequest;
use App\Http\Requests\CariHutangRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\SaldoRequest;
use App\Http\Requests\COARequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Hutang;
use App\DataIndex;
use App\Saldo;
use App\User;
use App\COA;
use PDF;
use DB;
use Carbon\Carbon;

class HutangController extends Controller
{
    public function index()
    {          
        $index  = DataIndex::all();
        $coa  = COA::all();
        $sal = Saldo::orderBy('id','desc')->limit(1)->get();

        $hutang = DB::table('hutang as h')
        ->join('coa as c','h.id_coa','=','c.id')
        ->get();

        $hutang = DB::table('hutang as h')
        ->get();
        $hutang = Carbon::now()->isoFormat('MMMM YYYY');
        $hutang = Hutang::with('saldo')->latest()->get();
        return view('pages.hutang.index',['hutang' => $hutang,'sal' => $sal]);
    }

    public function createHutang()
    {

        // $this->authorize('isAdminOrBendahara', COA::class);
        $index  = DataIndex::all();
        $coa    = COA::all();
        return view('pages.hutang.create',['index' => $index, 'coa'=>$coa]);
    
    }

    public function store(HutangRequest $request)
    {
        $saldo_sekarang = Saldo::latest()->first();
        $hutang = Hutang::create(
            ['saldo_id'=>$saldo_sekarang->id,
            'id_coa'=>$request->id_coa,
            'tanggaltransaksi_hutang' => $request->tanggaltransaksi_hutang,
            'jatuhtempo_hutang' => $request->jatuhtempo_hutang,
            'keterangan' => $request->keterangan,
            'jenis'=>'pengeluaran',
            'status'=>'Belum Bayar',
            'jumlah' => $request->jumlah,
            ]);
        return redirect()->back()->with('pesan', "Input data sukses");
    }

    public function edit($id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $hutang = Hutang::findOrfail($id);
        $coa  = COA::all();
        return view('pages.hutang.edit',['hutang' => $hutang,'coa'=>$coa]);
    }

    public function update(HutangRequest $request, $id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $hutang = Hutang::findOrfail($id);
        $hutang->keterangan = $request->input('keterangan');
        $hutang->update([
            'tanggaltransaksi_hutang' => $request->tanggaltransaksi_hutang,
            'jatuhtempo_hutang' => $request->jatuhtempo_hutang,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
        ]);
            Alert::success('Sukses', 'Update transaksi berhasil');
            return redirect()->back()->with('pesan', "Update transaksi berhasil");
        }

    public function destroy($id)
    {
        $hutang = Hutang::findOrFail($id);
        $saldo = Saldo::findOrFail($id);
        $hutang->saldo->delete();
    
        Alert::success('Sukses', 'Hapus transaksi hutang berhasil');
        return redirect()->back();
    }

    public function cari(CariHutangRequest $request)
    {
        $tanggal_awal = date('d-m-Y',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y',strtotime($request->tanggal_akhir));
        $sal = DB:: table('saldo as s')
        ->join('hutang as h','h.saldo_id','=','s.id')
        ->whereBetween('tanggaltransaksi_hutang',[$request->tanggal_awal,$request->tanggal_akhir]) 
        ->orderBy('s.id','desc')->limit(1)->get();
        $hutang = Hutang::with('saldo')->whereBetween('tanggaltransaksi_hutang',[$request->tanggal_awal,$request->tanggal_akhir])->get();
        
        session()->flash('info',"Hasil {$request->hutang} tanggal {$tanggal_awal} sampai {$tanggal_akhir}");
        return view('pages.hutang.index',['hutang' => $hutang,'sal' => $sal]);

    }
    public function pembayaran($id){
        $saldo_sekarang = Saldo::latest()->first();
        $hutang = Hutang::findOrFail($id);
        // echo $hutang->jumlah;
        if($hutang->status == "Belum Bayar"){
            $saldo= $saldo_sekarang->total - $hutang->jumlah;
        Saldo::create([
                'total' => $saldo,
            ]);
        $hutang->update(['status'=>'Sudah Bayar']);
        
        }else{

        }
        return redirect()->back()->with('pesan', "data sukses");

    }
}
