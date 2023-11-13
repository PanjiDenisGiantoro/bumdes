<?php

namespace App\Http\Controllers;

use App\Models\ManajemenAnggaran;
use Illuminate\Http\Request;

class ManajemenAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.manajemen_anggaran.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.manajemen_anggaran.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ManajemenAnggaran::create($request->all());

        return \redirect()
            ->route("semua_laporan.manajemen_anggaran.index")
            ->with("success", __("Pengajuan Management Anggaran Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(ManajemenAnggaran $manajemen_anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(ManajemenAnggaran $manajemen_anggaran)
    {
        return view("manajemen_anggaran.form", \compact("manajemen_anggaran"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManajemenAnggaran $manajemen_anggaran)
    {
        $manajemen_anggaran->fill($request->all());

        $manajemen_anggaran->save();

        return redirect()
            ->route("manajemen_anggaran.index")
            ->with("success", __("Perbaharui Management Anggaran Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManajemenAnggaran $manajemen_anggaran)
    {
        //
    }
}
