<?php

namespace App\Http\Controllers;

use App\Models\SettingKontak;
use Illuminate\Http\Request;

class SettingKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("setting_kontak.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_kontak.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SettingKontak::create($request->all());

        return \redirect()
            ->route("setting_kontak.index")
            ->with("message",(" Setting Kontak Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(SettingKontak $setting_kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingKontak $setting_kontak)
    {
        return view("setting_kontak.form", \compact("setting_kontak"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingKontak $setting_kontak)
    {
        $setting_kontak->fill($request->all());

        $setting_kontak->save();

        return redirect()
            ->route("setting_kontak.index")
            ->with("message",(" Setting Kontak Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingKontak $setting_kontak)
    {
        //
    }
}
