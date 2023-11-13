<?php

namespace App\Http\Controllers;

use App\Models\KodePengguna;
use App\Models\PersetujuanKeuangan;
use Illuminate\Http\Request;

class PersetujuanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $persetujuan =PersetujuanKeuangan::with('penggunas')->orderBy('created_at', 'DESC')->paginate(10);

        return view("setting_keuangan.persetujuan_keuangan.index",compact('persetujuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengguna = KodePengguna::all();
        return view("setting_keuangan.persetujuan_keuangan.form",compact('pengguna'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PersetujuanKeuangan::create($request->all());
        return \redirect()
            ->route("persetujuan_keuangan.index")
            ->with("message", (" Persetujuan Keuangan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PersetujuanKeuangan $persetujuan_keuangan)
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
        $pengguna = KodePengguna::all();
        $persetujuan_keuangan = PersetujuanKeuangan::where('id',$id)->first();

        return view("setting_keuangan.persetujuan_keuangan.form", \compact("persetujuan_keuangan",'pengguna'));
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
        $persetujuan_keuangan = PersetujuanKeuangan::find($id);
        $persetujuan_keuangan->fill($request->all());
        $persetujuan_keuangan->save();

        return redirect()
            ->route("persetujuan_keuangan.index")
            ->with("message",(" Persetujuan Keuangan Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $persetujuan = PersetujuanKeuangan::where('id',$id);
        $persetujuan->delete();
        return \redirect()
            ->route("persetujuan_keuangan.index")
            ->with("message", ("  Persetujuan Keuangan Berhasil Terhapus"));

    }
}
