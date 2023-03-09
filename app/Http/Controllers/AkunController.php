<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\AkunRequest;
use App\Http\Requests\CoaRequest;
use App\Http\Requests\IndexRequest;
use App\User;
use App\Akun;
use App\COA;
use App\DataIndex;
use DB;
class AkunController extends Controller
{
    public function index()
    {
        $akun = Akun::all();
        $index = DB::table('akun as a')
        ->join('index as i','a.id_index','=','i.id')
        ->get();            
        return view('pages.akun.index',['akun' => $akun]);
    }

    public function createAkun()
    {

        // $this->authorize('isAdminOrBendahara', COA::class);\
        $akun = Akun::all();
        $index = DataIndex::all();
        return view('pages.akun.create',['index' => $index,'akun' => $akun]);
    }

    public function store(AkunRequest $request)
    {
        Akun::create($request->all());
        return redirect()->back()->with('pesan', "Input data {$request->akun} sukses");
    }

    public function edit($id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $akun = Akun::findOrfail($id);
        return view('pages.akun.create',['akun' => $akun]);
    }
    
    public function destroy($id)
{
    $akun = Akun::findOrFail($id);
    $akun->delete();

    return view()->back()->with('pesan', "Hapus Transaksi data sukses");
}
}
