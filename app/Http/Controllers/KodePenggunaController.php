<?php

namespace App\Http\Controllers;

use App\Models\KodePengguna;
use App\Models\KodePerusahaan;
use Illuminate\Http\Request;

class KodePenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KodePengguna = KodePengguna::orderBy('created_at', 'DESC')->paginate(10);

        return view("tetapan.kode_pengguna.index",compact('KodePengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_pengguna.form");
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
            'nama_jabatan' => 'required|unique:kode_penggunas|max:255',
        ]);
        KodePengguna::create($request->all());

        return \redirect()
            ->route("kode_pengguna.index")
            ->with("message",(" Unit Kerja Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodePengguna $kode_pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodePengguna  $request,$id)
    {
        $KodePengguna = KodePengguna::where('id',$id)->first();

        return view("tetapan.kode_pengguna.form", \compact("KodePengguna"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $kode_pengguna = KodePengguna::find($id);

        $kode_pengguna->fill($request->all());

        $kode_pengguna->save();

        return redirect()
            ->route("kode_pengguna.index")
            ->with("message",("  Unit Kerja Berhasil Terupdate"));
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
        $bidangusaha = KodePengguna::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("kode_pengguna.index")
            ->with("message",(" Unit Kerja Berhasil Terhapus"));

    }
}
