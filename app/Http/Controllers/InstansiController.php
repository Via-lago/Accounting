<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InstansiRequest;
use App\Instansi;
use RealRashid\SweetAlert\Facades\Alert;

class InstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::first();
        return view('pages.instansi.index', ['instansi' => $instansi]);
    }

    public function edit($id)
    {
        $this->authorize('isAdmin', Instansi::class);
        $instansi = Instansi::findOrFail($id);
        return view('pages.instansi.edit', ['instansi' => $instansi]);
    }

    public function update(InstansiRequest $request, $id)
    {
        $this->authorize('isAdmin', Instansi::class);
        $instansi = Instansi::findOrFail($id);
        $instansi->update($request->all());
        Alert::success('Sukses', 'Profile instansi berhasil diupdate');
        return redirect()->route('instansi.index');
    }


}
