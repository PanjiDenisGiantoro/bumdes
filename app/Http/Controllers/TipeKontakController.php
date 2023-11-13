<?php

namespace App\Http\Controllers;

use App\Models\TipeKontak;
use Illuminate\Http\Request;

class TipeKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TipeKontak = TipeKontak::orderBy('created_at', 'DESC')->paginate(10);

        return view("setting_kontak.tipe_kontak.index",compact('TipeKontak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_kontak.tipe_kontak.form");
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
            'tipe_kontak' => 'required|unique:tipe_kontaks|max:255',
        ]);
        TipeKontak::create($request->all());

        return \redirect()
            ->route("tipe_kontak.index")
            ->with("message",(" Tipe Kontak Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TipeKontak $tipe_kontak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(TipeKontak $request,$id)
    {
        $tipe_kontak = TipeKontak::where('id',$id)->first();

        return view("setting_kontak.tipe_kontak.form", \compact("tipe_kontak"));
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
        $tipe_kontak = TipeKontak::find($id);

        $tipe_kontak->fill($request->all());

        $tipe_kontak->save();

        return redirect()
            ->route("tipe_kontak.index")
            ->with("message",(" Tipe Kontak Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = TipeKontak::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("tipe_kontak.index")
            ->with("message",(" Tipe Kontak Berhasil Terhapus"));

    }
}
