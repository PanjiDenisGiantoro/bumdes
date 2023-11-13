<?php

namespace App\Http\Controllers;

use App\Models\KodeBidangUsaha;
use App\Models\KodePerusahaan;
use App\Models\KodeStatusBangunan;
use Illuminate\Http\Request;

class KodeStatusBangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KodeStatusBangunan = KodeStatusBangunan::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.kode_status_bangunan.index",compact('KodeStatusBangunan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kode_status_bangunan.form");
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
            'status_bangunan' => 'required|unique:kode_status_bangunans|max:255',
        ]);
        KodeStatusBangunan::create($request->all());
        return \redirect()
            ->route("kode_status_bangunan.index")
            ->with("message", ("  Status Bangunan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeStatusBangunan $kode_status_bangunan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeStatusBangunan $request,$id)
    {
        $KodeStatusBangunan = KodeStatusBangunan::where('id',$id)->first();
        return view("tetapan.kode_status_bangunan.form", \compact("KodeStatusBangunan"));
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
        $kode_bidang_usaha = KodeStatusBangunan::find($id);
        $kode_bidang_usaha->fill($request->all());
        $kode_bidang_usaha->save();

        return redirect()
            ->route("kode_status_bangunan.index")
            ->with("message", ("  Status Bangunan Berhasil Terupdate"));
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
        $bidangusaha = KodeStatusBangunan::where('id',$id);
        $bidangusaha->delete();
        return \redirect()
            ->route("kode_status_bangunan.index")
            ->with("message", ("   Status Bangunan Berhasil Terhapus"));

    }
}
