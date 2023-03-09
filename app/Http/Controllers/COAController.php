<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\CoaRequest;
use App\Http\Requests\IndexRequest;
use App\User;
use App\COA;
use App\DataIndex;
use DB;
class COAController extends Controller
{
    public function index()
    {
        $coa = COA::all();
        $index = DB::table('coa as c')
        ->join('index as i','c.id_index','=','i.id')
        ->get();            
        return view('pages.coa.index',['coa' => $coa]);
    }

    public function createCOA()
    {
        // $this->authorize('isAdminOrBendahara', COA::class);
        $coa = COA::all();
        $index = DataIndex::all();
        return view('pages.coa.create',['index' => $index,'coa' => $coa]);
    }

    public function store(CoaRequest $request)
    {
        COA::create($request->all());
        return redirect()->back()->with('pesan', "Input data {$request->coa} sukses");
    }

    public function edit(COARequest $request, $id)
    {
        // $this->authorize('isAdminOrBendahara', Transaksi::class);
        $coa = COA::findOrfail($id);
        return view('pages.coa.edit',['coa' => $coa]);
    }

    public function update($id)
    {
        $coa = COA::findOrfail($id);
        Alert::success('Sukses', 'Update transaksi berhasil');
        return redirect()->back();
    }
    
    public function destroy($id)
{
    $coa = COA::findOrFail($id);
    $coa->delete();

    Alert::success('Sukses', 'Hapus COA berhasil');
    return redirect()->back();
}
    

}
