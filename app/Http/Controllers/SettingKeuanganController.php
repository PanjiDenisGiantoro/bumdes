<?php

namespace App\Http\Controllers;

use App\Models\SettingKeuangan;
use Illuminate\Http\Request;

class SettingKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("setting_keuangan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_keuangan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SettingKeuangan::create($request->all());

        return \redirect()
            ->route("setting_keuangan.index")
            ->with("success", __("Pengajuan Setting Keuangan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(SettingKeuangan $setting_keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingKeuangan $setting_keuangan)
    {
        return view("setting_keuangan.form", \compact("setting_keuangan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingKeuangan $setting_keuangan)
    {
        $setting_keuangan->fill($request->all());

        $setting_keuangan->save();

        return redirect()
            ->route("setting_keuangan.index")
            ->with("success", __("Perbaharui Setting Keuangan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingKeuangan $setting_keuangan)
    {
        //
    }
}
