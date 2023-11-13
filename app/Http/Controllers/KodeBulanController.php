<?php

namespace App\Http\Controllers;

use App\Models\KodeBulan;
use Illuminate\Http\Request;

class KodeBulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("tetapan.kode_bulan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_bulan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KodeBulan::create($request->all());

        return \redirect()
            ->route("tetapan.kode_bulan.index")
            ->with("success", __("Kode Bulan berjaya"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeBulan $kode_bulan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeBulan $kode_bulan)
    {
        return view("kode_bulan.form", \compact("kode_bulan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KodeBulan $kode_bulan)
    {
        $kode_bulan->fill($request->all());

        $kode_bulan->save();

        return redirect()
            ->route("kode_bulan.index")
            ->with("success", __("Perbaharui Kode Bulan berjaya"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodeBulan $kode_bulan)
    {
        //
    }
}
