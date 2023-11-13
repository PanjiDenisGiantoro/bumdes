<?php

namespace App\Http\Controllers;

use App\Models\DetailAsetTetap;
use Illuminate\Http\Request;

class DetailAsetTetapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.detail_aset_tetap.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.detail_aset_tetap.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DetailAsetTetap::create($request->all());

        return \redirect()
            ->route("semua_laporan.detail_aset_tetap.index")
            ->with("success", __("Pengajuan Detail Aset Tetap Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(DetailAsetTetap $detail_aset_tetap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailAsetTetap $detail_aset_tetap)
    {
        return view("detail_aset_tetap.form", \compact("detail_aset_tetap"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailAsetTetap $detail_aset_tetap)
    {
        $detail_aset_tetap->fill($request->all());

        $detail_aset_tetap->save();

        return redirect()
            ->route("detail_aset_tetap.index")
            ->with("success", __("Perbaharui Detail Aset Tetap Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailAsetTetap $detail_aset_tetap)
    {
        //
    }
}
