<?php

namespace App\Http\Controllers;

use App\Models\TujuanPengajuan;
use Illuminate\Http\Request;

class TujuanPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tujuan_pengajuan = TujuanPengajuan::orderBy('created_at', 'DESC')->paginate(10);

        return view("tetapan.tujuan_pengajuan.index",compact('tujuan_pengajuan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.tujuan_pengajuan.form");

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
            'nama_tujuan_pengajuan' => 'required|unique:tujuan_pengajuans|max:255',
        ]);
        TujuanPengajuan::create($request->all());

        return \redirect()
            ->route("tujuan_pengajuan.index")
            ->with("message",(" Tujuan Pengajuan Berhasil Terdaftar"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TujuanPengajuan  $tujuanPengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(TujuanPengajuan $tujuanPengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TujuanPengajuan  $tujuanPengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tujuan_pengajuan = TujuanPengajuan::where('id',$id)->first();

        return view("tetapan.tujuan_pengajuan.form", \compact("tujuan_pengajuan"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TujuanPengajuan  $tujuanPengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tujuan_pengajuan = TujuanPengajuan::find($id);

        $tujuan_pengajuan->fill($request->all());

        $tujuan_pengajuan->save();

        return redirect()
            ->route("tujuan_pengajuan.index")
            ->with("message",(" Tujuan Pengajuan Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TujuanPengajuan  $tujuanPengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tujuan_pengajuan = TujuanPengajuan::where('id',$id);
        $tujuan_pengajuan->delete();
        return redirect()
            ->route("tujuan_pengajuan.index")
            ->with("message",(" Tujuan Pengajuan Berhasil Terhapus"));

    }
}
