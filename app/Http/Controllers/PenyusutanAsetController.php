<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\PenyusutanAset;
use Illuminate\Http\Request;

class PenyusutanAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asets = Aset::where('disusutkan' ,'=',1)->paginate(10);

        return view("penyusutan_aset.index",compact('asets'));
         // \compact("penyusutan_asets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("penyusutan_aset.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PenyusutanAset::create($request->all());

        return redirect()
            ->route("penyusutan_aset.index")
            ->with("success", __("Pengajuan Penyusutan Aset Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(PenyusutanAset $penyusutan_aset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(PenyusutanAset $penyusutan_aset)
    {
        return view("penyusutan_aset.edit", \compact("penyusutan_aset"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenyusutanAset $penyusutan_aset)
    {
        $penyusutan_aset->fill($request->all());

        $penyusutan_aset->save();

        return redirect()
            ->route("penyusutan_aset.index")
            ->with("success", __("Perbaharui Penyusutan Aset Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenyusutanAset $penyusutan_aset)
    {
        //
    }
}
