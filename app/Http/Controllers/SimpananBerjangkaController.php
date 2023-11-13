<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpananBerjangkaController extends Controller
{
    public function index()
    {
        return view('simpanan_berjangka.index');
    }
}
