<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransaksiRequest;
use App\Http\Requests\EditTransaksiRequest;
use App\Http\Requests\CariTransaksiRequest;
use App\Http\Requests\LaporanTransaksiRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\SaldoRequest;
use App\Http\Requests\COARequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Transaksi;
use App\DataIndex;
use App\Saldo;
use App\User;
use App\COA;
use PDF;
use DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $index  = DataIndex::all();
        $coa  = COA::all();
        $sal = Saldo::orderBy('id','desc')->limit(1)->get();

        $transaksi = DB::table('transaksi as t')
        ->join('coa as c','t.id_coa','=','c.id')
        ->whereMonth('t.tanggal_transaksi',Carbon::now()->month)
        ->get();

        // $transaksi = DB::table('transaksi')
        // ->whereMonth('tanggal_transaksi',Carbon::now()->month)
        // ->get();

        $transaksi = Carbon::now()->isoFormat('MMMM YYYY');

        $transaksi = Transaksi::with('saldo')->latest()->get();
        return view('pages.transaksi.index',['transaksi' => $transaksi,'sal' => $sal]);
    }

    public function createTransaksi()
    {
        // $this->authorize('isAdminOrBendahara', COA::class);
        $index  = DataIndex::all();
        $coa    = COA::all();
        return view('pages.transaksi.create',['index' => $index, 'coa'=>$coa]);
    }

    public function store(TransaksiRequest $request)
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

        $saldo->transaksi()->create($request->all());
        // Transaksi::create($request->all());
        return redirect()->back()->with('pesan', "Input data {$request->transaksi} sukses");
    }
    public function edit($id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $transaksi = Transaksi::findOrfail($id);
        $coa  = COA::all();
        // $transaksi = DB::table('transaksi as t')
        // ->join('coa as c','t.id_coa','=','c.id')
        // ->get();

        return view('pages.transaksi.edit',['transaksi' => $transaksi,'coa'=>$coa]);
    }

    public function update(TransaksiRequest $request, $id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        // $saldo = Saldo::where('id', $transaksi->saldo_id)->first();
         
        $transaksi = Transaksi::findOrfail($id);
        // $transaksi= $transaksi->keterangan;
        $transaksi->keterangan = $request->input('keterangan');
        $transaksi->update([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'keterangan' => $request->keterangan,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
        ]);
            Alert::success('Sukses', 'Update transaksi berhasil');
            return redirect()->back()->with('pesan', "Update transaksi berhasil");
        }
    
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $saldo = Saldo::findOrFail($transaksi->saldo_id);
        // $transaksi->delete();

        if ($transaksi->jenis == 'pemasukan') {
            $saldo_terdampak = Saldo::where('id','>', $saldo->id)->get();
            foreach ($saldo_terdampak as $item) {
                $item->update([
                        'total' => $item->total + $transaksi->jumlah,
                        ]);
            }
        }

        if ($transaksi->jenis == 'pengeluaran') {
            $saldo_terdampak = Saldo::where('id','>', $saldo->id)->get();
            foreach ($saldo_terdampak as $item) {
                $item->update([
                        'total' => $item->total - $transaksi->jumlah,
                ]);
            }
        }

        $saldo->transaksi->delete();
        $saldo->delete();
    
        Alert::success('Sukses', 'Hapus transaksi berhasil');
        return redirect()->back();
    }

    public function cari(CariTransaksiRequest $request)
    {
        $tanggal_awal = date('d-m-Y',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y',strtotime($request->tanggal_akhir));
        $sal = DB:: table('saldo as s')
        ->join('transaksi as t','t.saldo_id','=','s.id')
        ->whereBetween('tanggal_transaksi',[$request->tanggal_awal,$request->tanggal_akhir]) 
        ->orderBy('s.id','desc')->limit(1)->get();
        $transaksi = Transaksi::with('saldo')->whereBetween('tanggal_transaksi',[$request->tanggal_awal,$request->tanggal_akhir])->get();
        
        session()->flash('info',"Hasil {$request->transaksi} tanggal {$tanggal_awal} sampai {$tanggal_akhir}");
        return view('pages.transaksi.index',['transaksi' => $transaksi,'sal' => $sal]);

    }
    public function laporan()
    {
        return view('pages.transaksi.laporan');
    }

    public function laporanPDF(LaporanTransaksiRequest $request )
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $tanggal_awal = date('d-m-Y',strtotime($request->tanggal_awal));
        $tanggal_akhir = date('d-m-Y',strtotime($request->tanggal_akhir));
        $periode = $tanggal_awal." sampai ".$tanggal_akhir;
        $sal = DB:: table('saldo as s')
        ->join('transaksi as t','t.saldo_id','=','s.id')
        ->whereBetween('tanggal_transaksi',[$request->tanggal_awal,$request->tanggal_akhir]) 
        ->orderBy('s.id','desc')->limit(1)->get();
        $transaksi = Transaksi::with('saldo')->whereBetween('tanggal_transaksi',[$request->tanggal_awal,$request->tanggal_akhir])->get();
        $pdf = PDF::loadView('pages.transaksi.laporan_pdf', ['sal' => $sal, 'periode' => $periode, 'transaksi' => $transaksi]);
            return $pdf->download("Laporan Transaksi {$periode}");
    }
}
