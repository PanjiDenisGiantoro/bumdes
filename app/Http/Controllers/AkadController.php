<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\Anggota;
use App\Models\KodePendidikan;
use App\Models\KodeStatusKeluarga;
use Illuminate\Http\Request;

class AkadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $akad = Akad::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.kode_akad.index",compact('akad'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akad = false;

        return view("tetapan.kode_akad.form", compact('akad'));
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
    public function edit(KodePendidikan $request,$id)
    {
        $akad = Akad::where('id',$id)->first();

        return view("tetapan.kode_akad.form", \compact("akad"));
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
        $akad = Akad::find($id);
        $akad->fill($request->all());
        $akad->save();
        return redirect()
            ->route("akad.index")
            ->with("message",(" Akad Berhasil Terupdate"));
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
