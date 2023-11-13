<?php

namespace App\Http\Controllers;

use App\Models\PajakPenjualan;
use App\Models\PembelianPenerimaanBody;
use App\Models\Pengiriman;
use Illuminate\Http\Request;

class PajakPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();
        //query untuk menampilkan total ppn dan pph
        $ppn = Pengiriman::sum('PPN');
        $pph = Pengiriman::sum('PPH');
        $ppnpembelianppn=PembelianPenerimaanBody::sum('total_ppn');
        $ppnpembelianpph=PembelianPenerimaanBody::sum('total_pph');
        return view("semua_laporan.pajak_penjualan.index",compact('ppn','pph','ppnpembelianppn','ppnpembelianpph'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pajak_penjualan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PajakPenjualan::create($request->all());

        return \redirect()
            ->route("semua_laporan.pajak_penjualan.index")
            ->with("success", __("Pengajuan Pajak Penjualan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PajakPenjualan $pajak_penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PajakPenjualan $pajak_penjualan)
    {
        return view("pajak_penjualan.form", \compact("pajak_penjualan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PajakPenjualan $pajak_penjualan)
    {
        $pajak_penjualan->fill($request->all());

        $pajak_penjualan->save();

        return redirect()
            ->route("pajak_penjualan.index")
            ->with("success", __("Perbaharui Pajak Penjualan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PajakPenjualan $pajak_penjualan)
    {
        //
    }
}
