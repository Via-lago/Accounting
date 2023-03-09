<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\TargetRequest;
use App\User;
use App\Target;

class TargetController extends Controller
{
    public function index()
    {
        $target = Target::all();
        return view('pages.target.index',['target' => $target]);
    }

    public function createIndex()
    {
        return view('pages.target.create');
    }

    public function store(TargetRequest $request)
    {
        Target::create($request->all());
        return redirect()->back()->with('pesan', "Input data {$request->target_penjualan} sukses");
    }  
}
