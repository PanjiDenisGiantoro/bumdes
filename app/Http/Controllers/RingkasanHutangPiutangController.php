<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RingkasanHutangPiutangController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view("semua_laporan.ringkasan_hutang_piutang.index"); 
    }
}
