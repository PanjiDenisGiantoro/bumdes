<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\PemetaanAkun;
use Illuminate\Http\Request;

class PemetaanAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $setting_keuangans = Tetapan::paginate();
        $akun = AkunPerkiraan::all();
        return view("setting_keuangan.pemetaan_akun.index",compact('akun'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_keuangan.pemetaan_akun.form");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PemetaanAkun::create($request->all());

        return \redirect()
            ->route("pemetaan_akun.edit",1)
            ->with("message",("Pemetaan Akun Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PemetaanAkun $pemetaan_akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $akun = AkunPerkiraan::all();

        $pemetaan_akun = PemetaanAkun::find($id);
        return view("setting_keuangan.pemetaan_akun.index", \compact("pemetaan_akun",'akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemetaanAkun $pemetaan_akun)
    {
        $pemetaan_akun->fill($request->all());

        $pemetaan_akun->save();

        return redirect()
            ->route("pemetaan_akun.edit",1)
            ->with("message",("Pemetaan Akun Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemetaanAkun $pemetaan_akun)
    {
        //
    }
}
