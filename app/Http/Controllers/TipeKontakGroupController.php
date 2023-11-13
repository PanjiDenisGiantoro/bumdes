<?php

namespace App\Http\Controllers;

use App\Models\TipeKontakGroup;
use Illuminate\Http\Request;

class TipeKontakGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TipeKontakGroup = TipeKontakGroup::orderBy('created_at', 'DESC')->paginate(10);

        return view("setting_kontak.tipe_kontak_group.index",compact('TipeKontakGroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_kontak.tipe_kontak_group.form");
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
            'tipe_kontak_group' => 'required|unique:tipe_kontak_groups|max:255',
        ]);
        TipeKontakGroup::create($request->all());

        return \redirect()
            ->route("tipe_kontak_group.index")
            ->with("message",(" Tipe Kontak Group Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TipeKontakGroup $tipe_kontak_group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(TipeKontakGroup $request,$id)
    {
        $tipe_kontak_group = TipeKontakGroup::where('id',$id)->first();

        return view("setting_kontak.tipe_kontak_group.form", \compact("tipe_kontak_group"));
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
        $tipe_kontak_group = TipeKontakGroup::find($id);

        $tipe_kontak_group->fill($request->all());

        $tipe_kontak_group->save();

        return redirect()
            ->route("tipe_kontak_group.index")
            ->with("message",("Tipe Kontak Group Berhasil Terupdate"));
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
        $bidangusaha = TipeKontakGroup::where('id',$id);
        $bidangusaha->delete();
        return \redirect()
            ->route("tipe_kontak_group.index")
            ->with("message",("  Tipe Kontak Group Berhasil Terhapus"));

    }
}
