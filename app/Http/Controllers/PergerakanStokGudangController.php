<?php

namespace App\Http\Controllers;

use App\Models\PergerakanStokGudang;
use Illuminate\Http\Request;

class PergerakanStokGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.pergerakan_stok_gudang.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pergerakan_stok_gudang.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PergerakanStokGudang::create($request->all());

        return \redirect()
            ->route("semua_laporan.pergerakan_stok_gudang.index")
            ->with("success", __("Pengajuan Pergerakan Stok Gudang Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PergerakanStokGudang $pergerakan_stok_gudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PergerakanStokGudang $pergerakan_stok_gudang)
    {
        return view("pergerakan_stok_gudang.form", \compact("pergerakan_stok_gudang"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PergerakanStokGudang $pergerakan_stok_gudang)
    {
        $pergerakan_stok_gudang->fill($request->all());

        $pergerakan_stok_gudang->save();

        return redirect()
            ->route("pergerakan_stok_gudang.index")
            ->with("success", __("Perbaharui Pergerakan Stok Gudang Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PergerakanStokGudang $pergerakan_stok_gudang)
    {
        //
    }
}
