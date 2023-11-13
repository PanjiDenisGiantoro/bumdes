<?php

namespace App\Http\Controllers;

use App\Models\PengirimanPenjualan;
use Illuminate\Http\Request;

class PengirimanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.pengiriman_penjualan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pengiriman_penjualan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PengirimanPenjualan::create($request->all());

        return \redirect()
            ->route("semua_laporan.pengiriman_penjualan.index")
            ->with("success", __("Pengajuan Pengiriman Penjualan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PengirimanPenjualan $pengiriman_penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PengirimanPenjualan $pengiriman_penjualan)
    {
        return view("pengiriman_penjualan.form", \compact("pengiriman_penjualan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengirimanPenjualan $pengiriman_penjualan)
    {
        $pengiriman_penjualan->fill($request->all());

        $pengiriman_penjualan->save();

        return redirect()
            ->route("pengiriman_penjualan.index")
            ->with("success", __("Perbaharui Pengiriman Penjualan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengirimanPenjualan $pengiriman_penjualan)
    {
        //
    }
}
