<?php

namespace App\Http\Controllers;

use App\Models\LaporanProduksi;
use Illuminate\Http\Request;

class LaporanProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.laporan_produksi.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.laporan_produksi.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LaporanProduksi::create($request->all());

        return \redirect()
            ->route("semua_laporan.laporan_produksi.index")
            ->with("success", __("Pengajuan Laporan Produksi Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanProduksi $laporan_produksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanProduksi $laporan_produksi)
    {
        return view("laporan_produksi.form", \compact("laporan_produksi"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanProduksi $laporan_produksi)
    {
        $laporan_produksi->fill($request->all());

        $laporan_produksi->save();

        return redirect()
            ->route("laporan_produksi.index")
            ->with("success", __("Perbaharui Laporan Produksi Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanProduksi $laporan_produksi)
    {
        //
    }
}
