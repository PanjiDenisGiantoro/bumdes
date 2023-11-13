<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BagiHasilSimpananController extends Controller
{


    public function index() {


        return view('bagi_hasil.simpanan.index');
    }
}
