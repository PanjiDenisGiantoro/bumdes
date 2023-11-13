<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\BiayaPerKontak;
use App\Models\Ledger;
use Illuminate\Http\Request;

class BiayaPerKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();
        $list =Ledger::with('akuns','anggota')->where('type','BN')->paginate(10);

        return view("semua_laporan.biaya_per_kontak.index",compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.biaya_per_kontak.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BiayaPerKontak::create($request->all());

        return \redirect()
            ->route("semua_laporan.biaya_per_kontak.index")
            ->with("success", __("Pengajuan Biaya Per Kontak Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(BiayaPerKontak $biaya_per_kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(BiayaPerKontak $biaya_per_kontak)
    {
        return view("biaya_per_kontak.form", \compact("biaya_per_kontak"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BiayaPerKontak $biaya_per_kontak)
    {
        $biaya_per_kontak->fill($request->all());

        $biaya_per_kontak->save();

        return redirect()
            ->route("biaya_per_kontak.index")
            ->with("success", __("Perbaharui Kode Perusahaan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BiayaPerKontak $biaya_per_kontak)
    {
        //
    }
}
