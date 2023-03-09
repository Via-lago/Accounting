<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class PiutangController extends Controller
{
    public function index()
    {          
        return view('pages.piutang.index');
    }
}
