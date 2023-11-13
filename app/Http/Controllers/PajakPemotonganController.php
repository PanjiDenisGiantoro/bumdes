<?php

namespace App\Http\Controllers;

use App\Models\PajakPemotongan;
use Illuminate\Http\Request;

class PajakPemotonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.pajak_pemotongan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pajak_pemotongan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PajakPemotongan::create($request->all());

        return \redirect()
            ->route("semua_laporan.pajak_pemotongan.index")
            ->with("success", __("Pengajuan Pajak Pemotongan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PajakPemotongan $pajak_pemotongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PajakPemotongan $pajak_pemotongan)
    {
        return view("pajak_pemotongan.form", \compact("pajak_pemotongan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PajakPemotongan $pajak_pemotongan)
    {
        $pajak_pemotongan->fill($request->all());

        $pajak_pemotongan->save();

        return redirect()
            ->route("pajak_pemotongan.index")
            ->with("success", __("Perbaharui Pajak Pemotongan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PajakPemotongan $pajak_pemotongan)
    {
        //
    }
}
