<?php

namespace App\Http\Controllers\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\pengajuan\durasi;
use App\Models\pengajuan\Margin;
use App\Models\pengajuan\SettingRasio;
use Illuminate\Http\Request;
use function redirect;
use function view;

class SettingRasioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rasio = SettingRasio::get();
        $durasi = durasi::get();
        $margin = Margin::get();

        return view('pengajuans.setting-rasio.index',compact('rasio','durasi','margin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengajuans.setting-rasio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rasio = SettingRasio::find($request->id);
        $rasio->rasio = $request->rasio;
        $rasio->save();

        return redirect()->route('setting_rasio.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengajuan\SettingRasio  $settingRasio
     * @return \Illuminate\Http\Response
     */
    public function show(SettingRasio $settingRasio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengajuan\SettingRasio  $settingRasio
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingRasio $settingRasio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengajuan\SettingRasio  $settingRasio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingRasio $settingRasio)
    {

        $rasio = SettingRasio::find($request->id);
        $rasio->rasio = $request->rasio;
        $rasio->save();

        return redirect()->route('setting-rasio.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengajuan\SettingRasio  $settingRasio
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingRasio $settingRasio)
    {
        //
    }
}
