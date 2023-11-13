<?php

namespace App\Http\Controllers;

use App\Models\KodeDaftarPengguna;
use Illuminate\Http\Request;

class KodeDaftarPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("tetapan.kode_daftar_pengguna.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_daftar_pengguna.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KodeDaftarPengguna::create($request->all());

        return \redirect()
            ->route("tetapan.kode_daftar_pengguna.index")
            ->with("message",(" Daftar Pengguna Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeDaftarPengguna $kode_daftar_pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeDaftarPengguna $kode_daftar_pengguna)
    {
        return view("kode_daftar_pengguna.form", \compact("kode_daftar_pengguna"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KodeDaftarPengguna $kode_daftar_pengguna)
    {
        $kode_daftar_pengguna->fill($request->all());

        $kode_daftar_pengguna->save();

        return redirect()
            ->route("kode_daftar_pengguna.index")
            ->with("message",("Perbaharui Daftar Pengguna Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodeDaftarPengguna $kode_daftar_pengguna)
    {
        //
    }
}
