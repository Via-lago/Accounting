<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\IndexRequest;
use App\User;
use App\DataIndex;

class IndexController extends Controller
{
    public function index()
    {
        $index = DataIndex::all();
        return view('pages.dataindex.index',['index' => $index]);
    }

    public function createIndex()
    {
        // $this->authorize('isAdminOrBendahara', COA::class);
        return view('pages.dataindex.create');
    }

    public function store(IndexRequest $request)
    {
        DataIndex::create($request->all());
        return redirect()->back()->with('pesan', "Input data {$request->index} sukses");
    }  
}
