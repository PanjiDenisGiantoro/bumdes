<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\Anggota;
use App\Models\KategoriProduk;
use App\Models\KodePendidikan;
use App\Models\KodePerusahaan;
use App\Models\KodeStatusKeluarga;
use App\Models\PenomoranAuto;
use Illuminate\Http\Request;

class PenomoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $penomoran = PenomoranAuto::all();
        return view("tetapan.penomoran",compact('penomoran'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_akad.form");
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
            'nama_akad' => 'required|unique:akads|max:255',
        ]);
        Akad::create($request->all());
        return \redirect()
            ->route("akad.index")
            ->with("message", ("  Akad Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodePendidikan $kode_pendidikan)
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
        $edit = PenomoranAuto::where('id',$id)->first();

        $produk = KategoriProduk::all();
        $perusahaan = KodePerusahaan::first();
        return view("tetapan.penomoran_edit", \compact("edit",'produk','perusahaan'));
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
        $edit = PenomoranAuto::find($id);
        $edit->fill($request->all());
        $edit->save();
        return redirect()
            ->route("penomoran.index")
            ->with("message",(" Penomoran Berhasil Terupdate"));
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
        $kode_pendidikan = Akad::where('id',$id);
        $kode_pendidikan->delete();
        return redirect()
            ->route("kode_akad.index")
            ->with("message",(" Akad Berhasil Terhapus"));

    }
}
