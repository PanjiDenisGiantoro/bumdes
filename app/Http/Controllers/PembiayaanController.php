<?php

namespace App\Http\Controllers;

use App\Models\Pembiayaan;
use Illuminate\Http\Request;

class PembiayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembiayaans = Pembiayaan::paginate();

        return view("pembiayaan.index", \compact("pembiayaans"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pembiayaan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pembiayaan::create($request->all());

        return \redirect()
            ->route("pembiayaan.index")
            ->with("success", __("Pengajuan pembiayaan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pembiayaan $pembiayaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembiayaan $pembiayaan)
    {
        return view("pembiayaan.form", \compact("pembiayaan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembiayaan $pembiayaan)
    {
        $pembiayaan->fill($request->all());

        $pembiayaan->save();

        return redirect()
            ->route("pembiayaan.index")
            ->with("success", __("Perbaharui pembiayaan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembiayaan $pembiayaan)
    {
        //
    }
}
