<?php

namespace App\Http\Controllers;

use App\Models\LaporanProduk;
use Illuminate\Http\Request;

class LaporanProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $laporan_produks = LaporanProduk::paginate();

        return view("laporan_produk.index");
         // \compact("laporan_produks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("laporan_produk.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LaporanProduk::create($request->all());

        return redirect()
            ->route("laporan_produk.index")
            ->with("success", __("Laporan Produk Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan Produk  $Laporan Produk
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanProduk $laporan_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan Produk  $Laporan Produk
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanProduk $laporan_produk)
    {
        return view("laporan_produk.edit", \compact("laporan_produk"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan Produk  $Laporan Produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanProduk $laporan_produk)
    {
        $laporan_produk->fill($request->all());

        $laporan_produk->save();

        return redirect()
            ->route("laporan_produk.index")
            ->with("success", __("Perbaharui Laporan Produk Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanProduk $laporan_produk)
    {
        //
    }
}
