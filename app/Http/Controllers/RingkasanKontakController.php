<?php

namespace App\Http\Controllers;

use App\Models\RingkasanKontak;
use Illuminate\Http\Request;

class RingkasanKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $daftar_pembiayaans = RingkasanKontak::paginate();

        return view("ringkasan_kontak.index");
         // \compact("ringkasan_kontaks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("ringkasan_kontak.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RingkasanKontak::create($request->all());

        return redirect()
            ->route("ringkasan_kontak.index")
            ->with("success", __("Daftar Ringkasan Kontak Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(RingkasanKontak $ringkasan_kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(RingkasanKontak $ringkasan_kontak)
    {
        return view("ringkasan_kontak.edit", \compact("ringkasan_kontak"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RingkasanKontak $ringkasan_kontak)
    {
        $ringkasan_kontak->fill($request->all());

        $ringkasan_kontak->save();

        return redirect()
            ->route("ringkasan_kontak.index")
            ->with("success", __("Perbaharui Ringkasan Kontak Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(RingkasanKontak $ringkasan_kontak)
    {
        //
    }
}
