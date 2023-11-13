<?php

namespace App\Http\Controllers;

use App\Models\Agunan;
use App\Models\Akad;
use App\Models\Anggota;
use App\Models\KodePendidikan;
use App\Models\KodeStatusKeluarga;
use Illuminate\Http\Request;

class AgunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agunan = Agunan::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.agunan.index",compact('agunan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.agunan.form");
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
            'nama_agunan' => 'required|unique:agunans|max:255',
        ]);
        Agunan::create($request->all());
        return \redirect()
            ->route("agunan.index")
            ->with("message", ("  Agunan Berhasil Terdaftar"));
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
    public function edit(Agunan $request,$id)
    {
        $agunan = Agunan::where('id',$id)->first();

        return view("tetapan.agunan.form", \compact("agunan"));
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
        $agunan = Agunan::find($id);
        $agunan->fill($request->all());
        $agunan->save();
        return redirect()
            ->route("agunan.index")
            ->with("message",(" Agunan Berhasil Terupdate"));
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
        $agunan = Agunan::where('id',$id);
        $agunan->delete();
        return redirect()
            ->route("agunan.index")
            ->with("message",(" Agunan Berhasil Terhapus"));

    }
}
