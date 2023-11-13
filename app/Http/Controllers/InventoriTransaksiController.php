<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoriTransaksiController extends Controller
{
    public function index()
    {
        return view('inventori.transaksi.index');
    }
}
