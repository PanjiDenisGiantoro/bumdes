<?php

namespace App\Http\Controllers;

use App\Models\AnggaranLabaRugi;
use Illuminate\Http\Request;

class AnggaranLabaRugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.anggaran_laba_rugi.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.anggaran_laba_rugi.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AnggaranLabaRugi::create($request->all());

        return \redirect()
            ->route("semua_laporan.anggaran_laba_rugi.index")
            ->with("success", __("Pengajuan Anggaran Laba Rugi Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(AnggaranLabaRugi $anggaran_laba_rugi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(AnggaranLabaRugi $anggaran_laba_rugi)
    {
        return view("anggaran_laba_rugi.form", \compact("anggaran_laba_rugi"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnggaranLabaRugi $anggaran_laba_rugi)
    {
        $anggaran_laba_rugi->fill($request->all());

        $anggaran_laba_rugi->save();

        return redirect()
            ->route("anggaran_laba_rugi.index")
            ->with("success", __("Perbaharui Anggaran Laba Rugi Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnggaranLabaRugi $anggaran_laba_rugi)
    {
        //
    }
}
