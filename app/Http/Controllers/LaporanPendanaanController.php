<?php

namespace App\Http\Controllers;

use App\Models\DaftarPembiayaan;
use Illuminate\Http\Request;

class LaporanPendanaanController extends Controller
{
    Public function index(Request $request)
    {
        $daftar = DaftarPembiayaan::with('anggota','sumber_pendanaan')->orderBy('created_at', 'DESC')->paginate(10);
        return view("semua_laporan.detail_pendanaan.index",compact('daftar'));

    }
}
