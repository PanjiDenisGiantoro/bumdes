<?php

namespace App\Http\Controllers;

use App\Models\SettingProduk;
use Illuminate\Http\Request;

class SettingProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("setting_produk.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_produk.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SettingProduk::create($request->all());

        return \redirect()
            ->route("setting_produk.index")
            ->with("success", __("Pengajuan Setting Produk Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(SettingProduk $setting_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingProduk $setting_produk)
    {
        return view("setting_produk.form", \compact("setting_produk"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingProduk $setting_produk)
    {
        $setting_produk->fill($request->all());

        $setting_produk->save();

        return redirect()
            ->route("setting_produk.index")
            ->with("success", __("Perbaharui Setting Produk Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingProduk $setting_produk)
    {
        //
    }
}
