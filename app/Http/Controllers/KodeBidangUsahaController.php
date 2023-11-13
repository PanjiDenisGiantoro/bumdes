<?php

namespace App\Http\Controllers;

use App\Models\KodeBidangUsaha;
use App\Models\KodePerusahaan;
use Illuminate\Http\Request;

class KodeBidangUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kodebidangusaha = KodeBidangUsaha::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.kode_bidang_usaha.index",compact('kodebidangusaha'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_bidang_usaha.form");
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
            'bidang_usaha' => 'required|unique:kode_bidang_usahas|max:255',
        ]);
        KodeBidangUsaha::create($request->all());

        return \redirect()
            ->route("kode_bidang_usaha.index")
            ->with("message", (" Bidang Usaha Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeBidangUsaha $kode_bidang_usaha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeBidangUsaha $request,$id)
    {

        $KodeBidangUsaha = KodeBidangUsaha::where('id',$id)->first();

        return view("tetapan.kode_bidang_usaha.form", \compact("KodeBidangUsaha"));
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

        $kode_bidang_usaha = KodeBidangUsaha::find($id);
        $kode_bidang_usaha->fill($request->all());
        $kode_bidang_usaha->save();
        return redirect()
            ->route("kode_bidang_usaha.index")
            ->with("message", (" Bidang Usaha Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = KodeBidangUsaha::where('id',$id);
        $bidangusaha->delete();
        return \redirect()
            ->route("kode_bidang_usaha.index")
            ->with("message", (" Bidang Usaha Berhasil Terhapus"));

    }
}
