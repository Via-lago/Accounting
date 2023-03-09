<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OperasionalRequest;
use App\Http\Requests\CariOperasionalRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\SaldoRequest;
use App\Http\Requests\COARequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Operasional;
use App\DataIndex;
use App\Saldo;
use App\User;
use App\COA;
use PDF;
use DB;
use Carbon\Carbon;

class OperasionalController extends Controller
{
    public function index()
    {
        $index  = DataIndex::all();
        $coa  = COA::all();
        $sal = Saldo::orderBy('id','desc')->limit(1)->get();

        $operasional = DB::table('operasional as o')
        ->join('coa as c','o.id_coa','=','c.id')
        ->get();

        $operasional = DB::table('operasional as o')
        ->get();

        $operasional = Carbon::now()->isoFormat('MMMM YYYY');

        $operasional = Operasional::with('saldo')->latest()->get();
        return view('pages.operasional.index',['operasional' => $operasional,'sal' => $sal]);
    }

    public function createOperasional()
    {

        // $this->authorize('isAdminOrBendahara', COA::class);
        $index  = DataIndex::all();
        $coa    = COA::all();
        return view('pages.operasional.create',['index' => $index, 'coa'=>$coa]);
    
    }

    public function store(OperasionalRequest $request)
    {
        $saldo_sekarang = Saldo::latest()->first();
        
        if ($saldo_sekarang === null) {
            $saldo_sekarang = 0;
        }else {
            $saldo_sekarang = $saldo_sekarang->total;
        }

        if ($request->jenis == 'pemasukan') {
            $total = $saldo_sekarang + $request->jumlah;
        }else{
            $total = $saldo_sekarang - $request->jumlah;
        }

        $saldo = Saldo::create([
            'total' => $total,
        ]);
// echo $saldo;
        // $saldo->operasional()->create($request->all());
        // Operasional::create($request->all());
        $operasional = Operasional::create(
        ['saldo_id'=>$saldo->id,
            'id_coa'=>$request->id_coa,
            'tanggal' => $request->tanggal,
            'ket' => $request->ket,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
        ]);
        // $operasional = Operasional::create();
        return redirect()->back()->with('pesan', "Input data sukses");
    }

    public function edit($id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $operasional = Operasional::findOrfail($id);
        $coa  = COA::all();
        // $transaksi = DB::table('transaksi as t')
        // ->join('coa as c','t.id_coa','=','c.id')
        // ->get();

        return view('pages.operasional.edit',['operasional' => $operasional,'coa'=>$coa]);
    }

    public function update(OperasionalRequest $request, $id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        // $saldo = Saldo::where('id', $transaksi->saldo_id)->first();
         
        $operasional = Operasional::findOrfail($id);
        // $transaksi= $transaksi->keterangan;
        $operasional->ket = $request->input('ket');
        $operasional->update([
            'tanggal' => $request->tanggal,
            'ket' => $request->ket,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
        ]);
            Alert::success('Sukses', 'Update transaksi berhasil');
            return redirect()->back()->with('pesan', "Update transaksi berhasil");
        }
    
    
    public function destroy($id)
    {
        $operasional = Operasional::findOrFail($id);
        $saldo = Saldo::findOrFail($operasional->saldo_id);

        if ($operasional->jenis == 'pemasukan') {
            $saldo_terdampak = Saldo::where('id','>', $saldo->id)->get();
            foreach ($saldo_terdampak as $item) {
                $item->update([
                        'total' => $item->total + $operasional->jumlah,
                        ]);
            }

        }

        if ($operasional->jenis == 'pengeluaran') {
            $saldo_terdampak = Saldo::where('id','>', $saldo->id)->get();
            foreach ($saldo_terdampak as $item) {
                $item->update([
                        'total' => $item->total - $operasional->jumlah,
                ]);
            }
        }

        $operasional->delete();
        $saldo->delete();
    
        Alert::success('Sukses', 'Hapus transaksi operasional berhasil');
        return redirect()->back();
    }

    public function cari(CariOperasionalRequest $request)
    {
        $tanggal_awal = date('d-m-Y',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y',strtotime($request->tanggal_akhir));
        $sal = DB:: table('saldo as s')
        ->join('operasional as o','o.saldo_id','=','s.id')
        ->whereBetween('tanggal',[$request->tanggal_awal,$request->tanggal_akhir]) 
        ->orderBy('s.id','desc')->limit(1)->get();
        $operasional = Operasional::with('saldo')->whereBetween('tanggal',[$request->tanggal_awal,$request->tanggal_akhir])->get();
        
        session()->flash('info',"Hasil {$request->operasional} tanggal {$tanggal_awal} sampai {$tanggal_akhir}");
        return view('pages.operasional.index',['operasional' => $operasional,'sal' => $sal]);

    }
}
