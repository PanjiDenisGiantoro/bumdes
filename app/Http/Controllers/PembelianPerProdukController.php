<?php

namespace App\Http\Controllers;

use App\Models\PembelianPenerimaan;
use App\Models\PembelianPenerimaanBody;
use App\Models\PembelianPerProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianPerProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         $pembelianProduk = PembelianPenerimaanBody::with('pembelianpenerimaan','produk')->selectRaw('count(kuantitas) as jumlah')->groupBy('produk_id')->get();
//
//         ddd($pembelianProduk);
        $pembelianProduk = DB::table('pembelian_penerimaan_body')
             ->leftJoin('pembelian_penerimaan','pembelian_penerimaan_body.pembelian_penerimaan_id','=','pembelian_penerimaan.pesananpembelian_id')
             ->leftJoin('daftar_produks','daftar_produks.id','=','pembelian_penerimaan_body.produk_id')
             ->selectRaw('count(kuantitas) as jumlah,nama_produk,kode_produk,harga_anggota,(count(kuantitas) * harga_anggota) as nilai')
             ->groupBy('produk_id')
             ->get();
        return view("semua_laporan.pembelian_per_produk.index",compact('pembelianProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pembelian_per_produk.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PembelianPerProduk::create($request->all());

        return \redirect()
            ->route("semua_laporan.pembelian_per_produk.index")
            ->with("success", __("Pengajuan Pembelian Per Produk Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PembelianPerProduk $pembelian_per_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PembelianPerProduk $pembelian_per_produk)
    {
        return view("pembelian_per_produk.form", \compact("pembelian_per_produk"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembelianPerProduk $pembelian_per_produk)
    {
        $pembelian_per_produk->fill($request->all());

        $pembelian_per_produk->save();

        return redirect()
            ->route("pembelian_per_produk.index")
            ->with("success", __("Perbaharui Pembelian Per Produk Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembelianPerProduk $pembelian_per_produk)
    {
        //
    }
}
