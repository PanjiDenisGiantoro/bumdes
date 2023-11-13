<?php

namespace App\Http\Controllers;

use App\Models\SumberPendanaan;
use Illuminate\Http\Request;

class SumberPendanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumber_pendanaan = SumberPendanaan::orderBy('created_at', 'DESC')->paginate(10);

        return view("tetapan.sumber_pendanaan.index",compact('sumber_pendanaan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.sumber_pendanaan.form");

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
            'nama_sumber_pendanaan' => 'required|unique:sumber_pendanaans|max:255',
        ]);
        SumberPendanaan::create($request->all());

        return \redirect()
            ->route("sumber_pendanaan.index")
            ->with("message", (" Sumber Pendanaan Berhasil Terdaftar"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SumberPendanaan  $sumberPendanaan
     * @return \Illuminate\Http\Response
     */
    public function show(SumberPendanaan $sumberPendanaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SumberPendanaan  $sumberPendanaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $sumber_pendanaan = SumberPendanaan::where('id',$id)->first();

        return view("tetapan.sumber_pendanaan.form", \compact("sumber_pendanaan"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SumberPendanaan  $sumberPendanaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sumber_pendanaan = SumberPendanaan::find($id);

        $sumber_pendanaan->fill($request->all());

        $sumber_pendanaan->save();

        return redirect()
            ->route("sumber_pendanaan.index")
            ->with("message",(" Sumber Pendanaan Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SumberPendanaan  $sumberPendanaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sumber_pendanaan = SumberPendanaan::where('id',$id);
        $sumber_pendanaan->delete();
        return redirect()
            ->route("sumber_pendanaan.index")
            ->with("message",(" Sumber Pendanaan Berhasil Terhapus"));


    }
}
