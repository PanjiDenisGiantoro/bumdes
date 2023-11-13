<?php

namespace App\Http\Controllers;

use App\Models\PelepasanAset;
use App\Models\PelepasanAsetMgt;
use Illuminate\Http\Request;

class PelepasanAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();
        $pelepasan_aset_mgts = PelepasanAsetMgt::with('aset.kelompokaset')->paginate(10);

        return view("semua_laporan.pelepasan_aset.index",compact('pelepasan_aset_mgts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pelepasan_aset.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PelepasanAset::create($request->all());

        return \redirect()
            ->route("semua_laporan.pelepasan_aset.index")
            ->with("success", __("Pengajuan Pelepasan Aset Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PelepasanAset $pelepasan_aset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PelepasanAset $pelepasan_aset)
    {
        return view("pelepasan_aset.form", \compact("pelepasan_aset"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelepasanAset $pelepasan_aset)
    {
        $pelepasan_aset->fill($request->all());

        $pelepasan_aset->save();

        return redirect()
            ->route("pelepasan_aset.index")
            ->with("success", __("Perbaharui Pelepasan Aset Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelepasanAset $pelepasan_aset)
    {
        //
    }
}
