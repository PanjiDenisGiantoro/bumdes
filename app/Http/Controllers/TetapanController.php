<?php

namespace App\Http\Controllers;

use App\Models\KodeProfil;
use App\Models\PemetaanAkun;
use App\Models\Tetapan;
use Illuminate\Http\Request;

class TetapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        $profil = KodeProfil::where('id',1);
        $pemetaan = PemetaanAkun::where('id',1);
        return view("tetapan.index",compact('profil','pemetaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tetapan::create($request->all());

        return \redirect()
            ->route("tetapan.index")
            ->with("success", __("Pengajuan Tetapan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(Tetapan $tetapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tetapan $tetapan)
    {
        return view("tetapan.form", \compact("tetapan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tetapan $tetapan)
    {
        $tetapan->fill($request->all());

        $tetapan->save();

        return redirect()
            ->route("tetapan.index")
            ->with("success", __("Perbaharui Tetapan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tetapan $tetapan)
    {
        //
    }
}
