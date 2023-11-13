<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\TagihanPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();
    $list = DB::table('pengirimans')
        ->leftJoin('pengiriman_bodies','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
        ->leftJoin('daftar_warungs','daftar_warungs.id_anggota','=','pengirimans.id_pelanggan')
        ->where('status_pembayaran_penjualan','=','Belum Lunas')
        ->select('no_pengiriman','non_anggota','nama_warung','tanggal_pengiriman','pengirimans.total','bayar','sisa_tagihan')
        ->groupBy('pengirimans.id')
        ->paginate(10);

        return view("semua_laporan.tagihan_pelanggan.index",compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.tagihan_pelanggan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TagihanPelanggan::create($request->all());

        return \redirect()
            ->route("semua_laporan.tagihan_pelanggan.index")
            ->with("success", __("Pengajuan Tagihan Pelanggan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TagihanPelanggan $tagihan_pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(TagihanPelanggan $tagihan_pelanggan)
    {
        return view("tagihan_pelanggan.form", \compact("tagihan_pelanggan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagihanPelanggan $tagihan_pelanggan)
    {
        $tagihan_pelanggan->fill($request->all());

        $tagihan_pelanggan->save();

        return redirect()
            ->route("tagihan_pelanggan.index")
            ->with("success", __("Perbaharui Tagihan Pelanggan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagihanPelanggan $tagihan_pelanggan)
    {
        //
    }
}
