<?php

namespace App\Http\Controllers;

use App\Models\RingkasanProduk;
use Illuminate\Http\Request;

class RingkasanProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $daftar_pembiayaans = RingkasanProduk::paginate();

        return view("ringkasan_produk.index");
         // \compact("ringkasan_produks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ringkasan_produk.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RingkasanProduk::create($request->all());

        return redirect()
            ->route("ringkasan_produk.index")
            ->with("success", __("Pengajuan Ringkasan Produk Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(RingkasanProduk $ringkasan_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(RingkasanProduk $ringkasan_produk)
    {
        return view("ringkasan_produk.edit", \compact("ringkasan_produk"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RingkasanProduk $ringkasan_produk)
    {
        $ringkasan_produk->fill($request->all());

        $ringkasan_produk->save();

        return redirect()
            ->route("ringkasan_produk.index")
            ->with("success", __("Perbaharui Ringkasa Produk Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(RingkasanProduk $ringkasan_produk)
    {
        //
    }
}
