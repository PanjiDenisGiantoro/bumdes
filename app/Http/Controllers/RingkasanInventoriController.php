<?php

namespace App\Http\Controllers;

use App\Models\RingkasanInventori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RingkasanInventoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = DB::table('daftar_produks')
            ->leftJoin('pengiriman_bodies','daftar_produks.id','=','pengiriman_bodies.id_produk')
            ->leftJoin('pembelian_penerimaan_body','daftar_produks.id','=','pembelian_penerimaan_body.produk_id')
            ->selectRaw('sum(pengiriman_bodies.qty) as jual,sum(pembelian_penerimaan_body.kuantitas) as beli,(sum(pengiriman_bodies.qty) + sum(pembelian_penerimaan_body.kuantitas)) as total,nama_produk,harga_beli,stok,daftar_produks.id,kode_produk')
            ->groupBy('daftar_produks.id')
            ->paginate(10);

        return view("semua_laporan.ringkasan_inventori.index",compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.ringkasan_inventori.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RingkasanInventori::create($request->all());

        return \redirect()
            ->route("semua_laporan.ringkasan_inventori.index")
            ->with("success", __("Pengajuan Ringkasan Inventori Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(RingkasanInventori $ringkasan_inventori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(RingkasanInventori $ringkasan_inventori)
    {
        return view("ringkasan_inventori.form", \compact("ringkasan_inventori"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RingkasanInventori $ringkasan_inventori)
    {
        $ringkasan_inventori->fill($request->all());

        $ringkasan_inventori->save();

        return redirect()
            ->route("ringkasan_inventori.index")
            ->with("success", __("Perbaharui Ringkasan Inventori Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RingkasanInventori $ringkasan_inventori)
    {
        //
    }
}
