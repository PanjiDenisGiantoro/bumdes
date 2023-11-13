<?php

namespace App\Http\Controllers;

use App\Models\DetailKlaimBiaya;
use Illuminate\Http\Request;

class DetailKlaimBiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.detail_klaim_biaya.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.detail_klaim_biaya.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DetailKlaimBiaya::create($request->all());

        return \redirect()
            ->route("semua_laporan.detail_klaim_biaya.index")
            ->with("success", __("Pengajuan Detail Klaim Biaya Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(DetailKlaimBiaya $detail_klaim_biaya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailKlaimBiaya $detail_klaim_biaya)
    {
        return view("detail_klaim_biaya.form", \compact("detail_klaim_biaya"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailKlaimBiaya $detail_klaim_biaya)
    {
        $detail_klaim_biaya->fill($request->all());

        $detail_klaim_biaya->save();

        return redirect()
            ->route("detail_klaim_biaya.index")
            ->with("success", __("Perbaharui Detail Klaim Biaya Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailKlaimBiaya $detail_klaim_biaya)
    {
        //
    }
}
