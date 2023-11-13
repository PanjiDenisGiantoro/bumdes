<?php

namespace App\Http\Controllers;

use App\Models\SumberPengembalian;
use App\Models\TemplateWa;
use Illuminate\Http\Request;

class SumberPengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumber_pengembalian = SumberPengembalian::orderBy('created_at', 'DESC')->paginate(10);

        return view("tetapan.sumber_pengembalian.index",compact('sumber_pengembalian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.sumber_pengembalian.form");
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
            'nama_sumber_pengembalian' => 'required|unique:sumber_pengembalians|max:255',
        ]);
        SumberPengembalian::create($request->all());

        return \redirect()
            ->route("sumber_pengembalian.index")
            ->with("message", (" Sumber Pengembalian Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(SumberPengembalian $sumberPengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $sumber_pengembalian = SumberPengembalian::where('id',$id)->first();

        return view("tetapan.sumber_pengembalian.form", \compact("sumber_pengembalian"));
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
        $sumber_pengembalian = SumberPengembalian::find($id);

        $sumber_pengembalian->fill($request->all());

        $sumber_pengembalian->save();

        return redirect()
            ->route("sumber_pengembalian.index")
            ->with("message",(" Sumber Pengembalian Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $sumber_pengembalian = SumberPengembalian::where('id',$id);
        $sumber_pengembalian->delete();
        return redirect()
            ->route("sumber_pengembalian.index")
            ->with("message",(" Sumber Pengembalian Berhasil Terhapus"));

    }
}
