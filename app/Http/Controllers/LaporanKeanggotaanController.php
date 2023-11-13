<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\StatusKeanggotaan;
use Illuminate\Http\Request;

class LaporanKeanggotaanController extends Controller
{
    public function index(Request $request)
    {

        $anggota = false;
        $kodeKategori = false;

        $kategoriAnggota = StatusKeanggotaan::all();
        if (!empty($request->id)){
            $anggota = Anggota::with('status_keanggotaans')->where('id_status_keanggotaan','=',$request->id)->paginate(10);
        }else{
            $anggota = Anggota::paginate(10);

        }
        return view("semua_laporan.detail_keanggotaan.index",compact('kategoriAnggota','anggota'));
    }
}
