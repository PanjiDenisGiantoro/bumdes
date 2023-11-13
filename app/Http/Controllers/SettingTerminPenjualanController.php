<?php

namespace App\Http\Controllers;

use App\Models\TerminPenjualan;
use Illuminate\Http\Request;

class SettingTerminPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TerminPenjualan = TerminPenjualan::orderBy('created_at', 'DESC')->paginate(10);

        return view("penjualan.setting.termin.index",compact('TerminPenjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("penjualan.setting.termin.form");
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
            'nama_termin_penjualan' => 'required|unique:termin_penjualans|max:255',
        ]);
        TerminPenjualan::create($request->all());

        return \redirect()
            ->route("setting_termin_penjualan.index")
            ->with("message",(" Termin  Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateSms $template_sms)
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
        $TerminPenjualan = TerminPenjualan::where('id',$id)->first();

        return view("penjualan.setting.termin.form", \compact("TerminPenjualan"));
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
        $template_sms = TerminPenjualan::find($id);

        $template_sms->fill($request->all());

        $template_sms->save();

        return redirect()
            ->route("setting_termin_penjualan.index")
            ->with("message", (" Termin  Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = TerminPenjualan::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("setting_termin_penjualan.index")
            ->with("message", (" Termin Berhasil Terhapus"));
    }
}
