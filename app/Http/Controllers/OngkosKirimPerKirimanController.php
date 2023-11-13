<?php

namespace App\Http\Controllers;

use App\Models\OngkosKirimPerKiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OngkosKirimPerKirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();


    $pengiriman = DB::table('pesanan_pembelian')
        ->leftJoin('pembelian_penerimaan', 'pembelian_penerimaan.pesananpembelian_id', '=', 'pesanan_pembelian.id')
        ->leftJoin('pembelian_penerimaan_body', 'pembelian_penerimaan.id', '=', 'pembelian_penerimaan_body.pembelian_penerimaan_id')
        ->leftJoin('ekspedisi_penjualans', 'ekspedisi_penjualans.id', '=', 'pesanan_pembelian.ekpedisi_id')
        ->select('ekspedisi_penjualans.nama_ekspedisi_penjualan', DB::raw('count(pembelian_penerimaan.id) as jumlah'), DB::raw('sum(pembelian_penerimaan_body.biaya_pengiriman) as biaya_pengiriman'))
        ->groupBy('ekspedisi_penjualans.nama_ekspedisi_penjualan')
        ->paginate(10);
        return view("semua_laporan.ongkos_kirim_per_kiriman.index",compact('pengiriman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.ongkos_kirim_per_kiriman.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        OngkosKirimPerKiriman::create($request->all());

        return \redirect()
            ->route("semua_laporan.ongkos_kirim_per_kiriman.index")
            ->with("success", __("Pengajuan Ongkos Kirim Per Kiriman Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(OngkosKirimPerKiriman $ongkos_kirim_per_kiriman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(OngkosKirimPerKiriman $ongkos_kirim_per_kiriman)
    {
        return view("ongkos_kirim_per_kiriman.form", \compact("ongkos_kirim_per_kiriman"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OngkosKirimPerKiriman $ongkos_kirim_per_kiriman)
    {
        $ongkos_kirim_per_kiriman->fill($request->all());

        $ongkos_kirim_per_kiriman->save();

        return redirect()
            ->route("ongkos_kirim_per_kiriman.index")
            ->with("success", __("Perbaharui Ongkos Kirim Per Kiriman Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(OngkosKirimPerKiriman $ongkos_kirim_per_kiriman)
    {
        //
    }
}
