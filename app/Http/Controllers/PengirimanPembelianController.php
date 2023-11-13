<?php

namespace App\Http\Controllers;

use App\Models\PengirimanPembelian;
use Illuminate\Http\Request;

class PengirimanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.pengiriman_pembelian.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pengiriman_pembelian.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PengirimanPembelian::create($request->all());

        return \redirect()
            ->route("semua_laporan.pengiriman_pembelian.index")
            ->with("success", __("Pengajuan Pengiriman Pembelian Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PengirimanPembelian $pengiriman_pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PengirimanPembelian $pengiriman_pembelian)
    {
        return view("pengiriman_pembelian.form", \compact("pengiriman_pembelian"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengirimanPembelian $pengiriman_pembelian)
    {
        $pengiriman_pembelian->fill($request->all());

        $pengiriman_pembelian->save();

        return redirect()
            ->route("pengiriman_pembelian.index")
            ->with("success", __("Perbaharui Pengiriman Pembelian Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengirimanPembelian $pengiriman_pembelian)
    {
        //
    }
}
