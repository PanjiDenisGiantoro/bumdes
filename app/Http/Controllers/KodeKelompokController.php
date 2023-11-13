<?php

namespace App\Http\Controllers;

use App\Models\KodeKelompok;
use Illuminate\Http\Request;

class KodeKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        $kodes = KodeKelompok::whereNull('parent_id')->paginate(10);

        return view("setting_keuangan.kode_kelompok.index", \compact("kodes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_keuangan.kode_kelompok.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KodeKelompok::create($request->all());

        return \redirect()
            ->route("kode_kelompok.index")
            ->with("message",(" Kode Kelompok Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeKelompok $kode_kelompok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeKelompok $kode_kelompok)
    {
        return view("setting_keuangan.kode_kelompok.form", \compact("kode_kelompok"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KodeKelompok $kode_kelompok)
    {
        $kode_kelompok->fill($request->all());

        $kode_kelompok->save();

        return redirect()
            ->route("kode_kelompok.index")
            ->with("message",(" Kode Kelompok Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kodekelompok= KodeKelompok::where('id',$id);
        $kodekelompok->delete();
        return \redirect()
            ->route("kode_kelompok.index")
            ->with("message", (" Kode Kelompok Berhasil Terhapus"));

    }
}
