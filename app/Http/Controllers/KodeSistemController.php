<?php

namespace App\Http\Controllers;

use App\Models\KodeSistem;
use Illuminate\Http\Request;

class KodeSistemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("tetapan.kode_sistem.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_sistem.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KodeSistem::create($request->all());

        return \redirect()
            ->route("tetapan.kode_sistem.index")
            ->with("success", __("Pengajuan Kode Sistem Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeSistem $kode_sistem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeSistem $kode_sistem)
    {
        return view("kode_sistem.form", \compact("kode_sistem"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KodeSistem $kode_sistem)
    {
        $kode_sistem->fill($request->all());

        $kode_sistem->save();

        return redirect()
            ->route("kode_sistem.index")
            ->with("success", __("Perbaharui Kode Sistem Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodeSistem $kode_sistem)
    {
        //
    }
}
