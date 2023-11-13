<?php

namespace App\Http\Controllers;

use App\Models\SemuaLaporan;
use Illuminate\Http\Request;

class SemuaLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SemuaLaporan::create($request->all());

        return \redirect()
            ->route("semua_laporan.index")
            ->with("success", __("Pengajuan Semua Laporan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(SemuaLaporan $semua_laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(SemuaLaporan $semua_laporan)
    {
        return view("semua_laporan.form", \compact("semua_laporan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SemuaLaporan $semua_laporan)
    {
        $semua_laporan->fill($request->all());

        $semua_laporan->save();

        return redirect()
            ->route("semua_laporan.index")
            ->with("success", __("Perbaharui Semua Laporan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SemuaLaporan $semua_laporan)
    {
        //
    }
}
