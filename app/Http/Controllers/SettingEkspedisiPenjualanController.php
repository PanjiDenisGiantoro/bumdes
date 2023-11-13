<?php

namespace App\Http\Controllers;

use App\Models\EkspedisiPenjualan;
use Illuminate\Http\Request;

class SettingEkspedisiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $EkspedisiPenjualan = EkspedisiPenjualan::orderBy('created_at', 'DESC')->paginate(10);

        return view("penjualan.setting.ekpedisi.index",compact('EkspedisiPenjualan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("penjualan.setting.ekpedisi.form");

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
            'nama_ekspedisi_penjualan' => 'required|unique:ekspedisi_penjualans|max:255',
        ]);
        EkspedisiPenjualan::create($request->all());
        return \redirect()
            ->route("ekspedisi_penjualan.index")
            ->with("message",(" Ekspedisi Berhasil Terdaftar"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $EkspedisiPenjualan = EkspedisiPenjualan::where('id',$id)->first();
        return view("penjualan.setting.ekpedisi.form", \compact("EkspedisiPenjualan"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $template_sms = EkspedisiPenjualan::find($id);

        $template_sms->fill($request->all());

        $template_sms->save();

        return redirect()
            ->route("ekspedisi_penjualan.index")
            ->with("message",(" Ekspedisi Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidangusaha = EkspedisiPenjualan::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("ekspedisi_penjualan.index")
            ->with("message",(" Ekspedisi Berhasil Terhapus"));

    }
}
