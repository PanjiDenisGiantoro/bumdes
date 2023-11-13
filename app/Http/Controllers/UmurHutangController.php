<?php

namespace App\Http\Controllers;

use App\Models\PembelianPembayaran;
use App\Models\PembelianPenerimaan;
use App\Models\UmurHutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmurHutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $history = DB::select(' SELECT non_anggota,historypembelians.total,
SUM(IF( TIMESTAMPDIFF(day, historypembelians.created_at , CURDATE()) < 30, historypembelians.bayar , 0)) AS kurang_satu_bulan,
SUM(IF( TIMESTAMPDIFF(day, historypembelians.created_at , CURDATE()) between 30 and 60, historypembelians.bayar , 0)) AS satu_bulan,
SUM(IF( TIMESTAMPDIFF(day, historypembelians.created_at , CURDATE()) between 60 and 90, historypembelians.bayar , 0)) AS dua_bulan,
SUM(IF( TIMESTAMPDIFF(day, historypembelians.created_at , CURDATE()) between 90 and 120, historypembelians.bayar , 0)) AS tiga_bulan,
SUM(IF( TIMESTAMPDIFF(day, historypembelians.created_at , CURDATE()) > 120, historypembelians.bayar , 0)) AS empat_bulan
FROM historypembelians
left join pembelian_pembayaran on pembelian_pembayaran.id = historypembelians.id_pengiriman
GROUP BY non_anggota');

        return view("semua_laporan.umur_hutang.index", [
            "history" => $history,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.umur_hutang.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        UmurHutang::create($request->all());

        return \redirect()
            ->route("semua_laporan.umur_hutang.index")
            ->with("success", __("Pengajuan Umur Hutang Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(UmurHutang $umur_hutang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(UmurHutang $umur_hutang)
    {
        return view("umur_hutang.form", \compact("umur_hutang"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UmurHutang $umur_hutang)
    {
        $umur_hutang->fill($request->all());

        $umur_hutang->save();

        return redirect()
            ->route("umur_hutang.index")
            ->with("success", __("Perbaharui Umur Hutang Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(UmurHutang $umur_hutang)
    {
        //
    }
}
