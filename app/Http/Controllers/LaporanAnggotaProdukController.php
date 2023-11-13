<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\RekeningPembiayaan;
use App\Models\RekeningSimjaka;
use Illuminate\Http\Request;
use App\Models\RekeningSimpanan;

class LaporanAnggotaProdukController extends Controller
{
   public function index(Request $request)
   {
      $dataAnggota = false;
      $rekeningSimpanan = false;
      $rekeningBerjangka = false;
      $rekeningPembiayaan = false;
      $nama = false;
      $id = false;
      // dd($request->all());

      // Retrieved when user select the anggota name
      if ( !empty($request->id)) {

          $dataAnggota = Anggota::where('id', '=', $request->id)
              // ->filter($request->all())
              ->first();
          $id = $request->id;

          $rekeningSimpanan = RekeningSimpanan::
              where('anggota_id', '=', $request->id)
              // ->filter($request->all())
              ->get();

          $rekeningBerjangka = RekeningSimjaka::where('anggota_id', '=', $request->id)
              // ->filter($request->all())
              ->get();

          $rekeningPembiayaan = RekeningPembiayaan::where('anggota_id', '=', $request->id)
              ->get();
      }
      $namaAnggota = Anggota::all();

       return view('semua_laporan.anggotaproduk.index', compact('namaAnggota','dataAnggota', 'rekeningSimpanan', 'rekeningBerjangka', 'rekeningPembiayaan', 'id'));
   }
}
