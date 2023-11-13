<?php

namespace App\Http\Controllers;

use App\Models\RingkasanStokGudang;
use Illuminate\Http\Request;

class RingkasanStokGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.ringkasan_stok_gudang.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.ringkasan_stok_gudang.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RingkasanStokGudang::create($request->all());

        return \redirect()
            ->route("semua_laporan.ringkasan_stok_gudang.index")
            ->with("success", __("Pengajuan Ringkasan Stok Gudang Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(RingkasanStokGudang $ringkasan_stok_gudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(RingkasanStokGudang $ringkasan_stok_gudang)
    {
        return view("ringkasan_stok_gudang.form", \compact("ringkasan_stok_gudang"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RingkasanStokGudang $ringkasan_stok_gudang)
    {
        $ringkasan_stok_gudang->fill($request->all());

        $ringkasan_stok_gudang->save();

        return redirect()
            ->route("ringkasan_stok_gudang.index")
            ->with("success", __("Perbaharui Ringkasan Stok Gudang Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RingkasanStokGudang $ringkasan_stok_gudang)
    {
        //
    }
}
