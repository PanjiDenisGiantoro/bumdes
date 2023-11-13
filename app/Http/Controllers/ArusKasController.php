<?php

namespace App\Http\Controllers;

use App\Models\ArusKas;
use Illuminate\Http\Request;

class ArusKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.arus_kas.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.arus_kas.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ArusKas::create($request->all());

        return \redirect()
            ->route("semua_laporan.arus_kas.index")
            ->with("success", __("Pengajuan Arus Kas Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(ArusKas $arus_kas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(ArusKas $arus_kas)
    {
        return view("arus_kas.form", \compact("arus_kas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArusKas $arus_kas)
    {
        $arus_kas->fill($request->all());

        $arus_kas->save();

        return redirect()
            ->route("arus_kas.index")
            ->with("success", __("Perbaharui Arus Kas Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArusKas $arus_kas)
    {
        //
    }
}
