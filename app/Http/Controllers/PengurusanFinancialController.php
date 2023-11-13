<?php

namespace App\Http\Controllers;

use App\Models\PengurusanFinancial;
use Illuminate\Http\Request;

class PengurusanFinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.pengurusan_financial.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pengurusan_financial.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PengurusanFinancial::create($request->all());

        return \redirect()
            ->route("semua_laporan.pengurusan_financial.index")
            ->with("success", __("Pengajuan Pengurusan Financial Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PengurusanFinancial $pengurusan_financial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PengurusanFinancial $pengurusan_financial)
    {
        return view("pengurusan_financial.form", \compact("pengurusan_financial"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengurusanFinancial $pengurusan_financial)
    {
        $pengurusan_financial->fill($request->all());

        $pengurusan_financial->save();

        return redirect()
            ->route("pengurusan_financial.index")
            ->with("success", __("Perbaharui Pengurusan Financial Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengurusanFinancial $pengurusan_financial)
    {
        //
    }
}
