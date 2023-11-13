<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\PerpajakanKeuangan;
use Illuminate\Http\Request;

class PerpajakanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pajak = PerpajakanKeuangan::with('pajak_penjualan','pajak_pembelian')->orderBy('created_at','DESC')->paginate(10);

        return view("setting_keuangan.perpajakan_keuangan.index",compact('pajak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $GLList = AkunPerkiraan::pluck('nama','id');
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        return view("setting_keuangan.perpajakan_keuangan.form",compact('akun'));
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
            'nama_pajak' => 'required|unique:perpajakan_keuangans|max:255',
        ]);
        PerpajakanKeuangan::create($request->all());
        return \redirect()
            ->route("perpajakan_keuangan.index")
            ->with("message",(" Perpajakan Keuangan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PerpajakanKeuangan $perpajakan_keuangan)
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
        // $akun = AkunPerkiraan::pluck('nama','id');
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();

        $perpajakan_keuangan = PerpajakanKeuangan::where('id',$id)->first();

        return view("setting_keuangan.perpajakan_keuangan.form", \compact("perpajakan_keuangan",'akun'));
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
        $perpajakan_keuangan = PerpajakanKeuangan::find($id);

        $perpajakan_keuangan->fill($request->all());

        $perpajakan_keuangan->save();

        return redirect()
            ->route("perpajakan_keuangan.index")
            ->with("message",(" Perpajakan Keuangan Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = PerpajakanKeuangan::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("perpajakan_keuangan.index")
            ->with("message",(" Perpajakan Keuangan Berhasil Terhapus"));
    }
}
