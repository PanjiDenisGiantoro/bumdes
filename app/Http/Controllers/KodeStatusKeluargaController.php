<?php

namespace App\Http\Controllers;

use App\Models\KodeBidangUsaha;
use App\Models\KodeStatusKeluarga;
use Illuminate\Http\Request;

class KodeStatusKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KodeStatusKeluarga = KodeStatusKeluarga::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.kode_status_keluarga.index",compact('KodeStatusKeluarga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_status_keluarga.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status_dalam_keluarga' => 'required|unique:kode_status_keluargas|max:255',
        ]);
        KodeStatusKeluarga::create($request->all());
        return \redirect()
            ->route("kode_status_keluarga.index")
            ->with("message", ("  Status Keluarga Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeStatusKeluarga $kode_status_keluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeStatusKeluarga $request,$id)
    {
        $KodeStatusKeluarga = KodeStatusKeluarga::where('id',$id)->first();

        return view("tetapan.kode_status_keluarga.form", \compact("KodeStatusKeluarga"));
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
        $kode_status_keluarga = KodeStatusKeluarga::find($id);
        $kode_status_keluarga->fill($request->all());
        $kode_status_keluarga->save();

        return redirect()
            ->route("kode_status_keluarga.index")
            ->with("message", ("  Status Keluarga Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $bidangusaha = KodeStatusKeluarga::where('id',$id);
        $bidangusaha->delete();
        return \redirect()
            ->route("kode_status_keluarga.index")
            ->with("message", ("  Status Keluarga Berhasil Terhapus"));
    }
}
