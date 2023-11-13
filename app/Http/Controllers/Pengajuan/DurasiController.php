<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\pengajuan\durasi;
use Illuminate\Http\Request;
use function redirect;

class DurasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //
        durasi::create($request->all());
        return redirect()->route('setting_rasio.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengajuan\durasi  $durasi
     * @return \Illuminate\Http\Response
     */
    public function show(durasi $durasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengajuan\durasi  $durasi
     * @return \Illuminate\Http\Response
     */
    public function edit(durasi $durasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengajuan\durasi  $durasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, durasi $durasi)
    {
        $rasio = durasi::find($request->id);
        $rasio->durasi = $request->durasi;
        $rasio->save();
        return redirect()->route('setting_rasio.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengajuan\durasi  $durasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $durasi = durasi::where('id',$id);
        $durasi->delete();
        return redirect()
            ->route("setting_rasio.index")
            ->with("success",(" Durasi Berhasil Terhapus"));

    }
}
