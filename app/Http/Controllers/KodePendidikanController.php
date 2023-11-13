<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KodePendidikan;
use App\Models\KodeStatusKeluarga;
use Illuminate\Http\Request;

class KodePendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $KodePendidikan = KodePendidikan::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.kode_pendidikan.index",compact('KodePendidikan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_pendidikan.form");
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
            'pendidikan' => 'required|unique:kode_pendidikans|max:255',
        ]);
        KodePendidikan::create($request->all());
        return \redirect()
            ->route("kode_pendidikan.index")
            ->with("message", ("  Pendidikan Berhasil Terdaftar"));
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
    public function edit(KodePendidikan $request,$id)
    {
        $KodePendidikan = KodePendidikan::where('id',$id)->first();

        return view("tetapan.kode_pendidikan.form", \compact("KodePendidikan"));
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
        $kode_pendidikan = KodePendidikan::find($id);
        $kode_pendidikan->fill($request->all());
        $kode_pendidikan->save();
        return redirect()
            ->route("kode_pendidikan.index")
            ->with("message",(" Pendidikan Berhasil Terupdate"));
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
        $kode_pendidikan = KodePendidikan::where('id',$id);
        $kode_pendidikan->delete();
        return redirect()
            ->route("kode_pendidikan.index")
            ->with("message",(" Pendidikan Berhasil Terhapus"));

    }
}
