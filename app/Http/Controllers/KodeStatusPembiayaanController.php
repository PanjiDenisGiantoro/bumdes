<?php

namespace App\Http\Controllers;

use App\Models\KodeStatusPembiayaan;
use Illuminate\Http\Request;

class KodeStatusPembiayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KodeStatusPembiayaan = KodeStatusPembiayaan::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.kode_status_pembiayaan.index",compact('KodeStatusPembiayaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_status_pembiayaan.form");
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
            'status_pembiayaan' => 'required|unique:kode_status_pembiayaans|max:255',
        ]);
        KodeStatusPembiayaan::create($request->all());

        return \redirect()
            ->route("kode_status_pembiayaan.index")
            ->with("message", ("  Tipe Pendanaan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeStatusPembiayaan $kode_status_pembiayaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeStatusPembiayaan $request,$id)
    {
        $KodeStatusPembiayaan = KodeStatusPembiayaan::where('id',$id)->first();

        return view("tetapan.kode_status_pembiayaan.form", \compact("KodeStatusPembiayaan"));
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
        $kode_status_pembiayaan = KodeStatusPembiayaan::find($id);
        $kode_status_pembiayaan->fill($request->all());
        $kode_status_pembiayaan->save();
        return redirect()
            ->route("kode_status_pembiayaan.index")
            ->with("message", ("  Tipe Pendanaan Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $kode_status_pembiayaan = KodeStatusPembiayaan::where('id',$id);
        $kode_status_pembiayaan->delete();
        return \redirect()
            ->route("kode_status_pembiayaan.index")
            ->with("message", ("  Tipe Pendanaan Berhasil Terhapus"));

    }
}
