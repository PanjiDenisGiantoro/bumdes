<?php

namespace App\Http\Controllers;

use App\Models\KodeKasArusAktivitas;
use Illuminate\Http\Request;

class KodeKasArusAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        $list = KodeKasArusAktivitas::all();
        return view("setting_keuangan.kode_kas_arus_aktivitas.index", compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_keuangan.kode_kas_arus_aktivitas.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KodeKasArusAktivitas::create($request->all());

        return \redirect()
            ->route("kode_kas_arus_aktivitas.index")
            ->with("message",(" Kas Arus Aktivitas Berhasil Tersimpan"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeKasArusAktivitas $kode_kas_arus_aktivitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kode_kas_arus_aktivitas = KodeKasArusAktivitas::where('id',$id)->first();

        return view("kode_kas_arus_aktivitas.form", \compact("kode_kas_arus_aktivitas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kode_kas_arus_aktivitas = KodeKasArusAktivitas::find($id);
        $kode_kas_arus_aktivitas->fill($request->all());
        $kode_kas_arus_aktivitas->save();
        return redirect()
            ->route("kode_kas_arus_aktivitas.index")
            ->with("message",(" Kas Arus Aktivitas Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arus_kas = KodeKasArusAktivitas::where('id',$id);
        $arus_kas->delete();
        return redirect()
            ->route("kode_kas_arus_aktivitas.index")
            ->with("message",(" Kas Arus Aktivitas Berhasil Terhapus"));

    }
}
