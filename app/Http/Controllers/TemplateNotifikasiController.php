<?php

namespace App\Http\Controllers;

use App\Models\TemplateNotifikasi;
use Illuminate\Http\Request;

class TemplateNotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templatenotif = TemplateNotifikasi::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.template_notifikasi.index",compact('templatenotif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.template_notifikasi.form");
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
            'template_notifikasi' => 'required|unique:template_notifikasis|max:255',
        ]);
        TemplateNotifikasi::create($request->all());

        return \redirect()
            ->route("template_notifikasi.index")
            ->with("message",(" Template Notifikasi Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateNotifikasi $template_notifikasi)
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
        $template_notifikasi = TemplateNotifikasi::where('id',$id)->first();
        return view("tetapan.template_notifikasi.form", \compact("template_notifikasi"));
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
        $template_notifikasi = TemplateNotifikasi::find($id);

        $template_notifikasi->fill($request->all());

        $template_notifikasi->save();

        return redirect()
            ->route("template_notifikasi.index")
            ->with("message",(" Notifikasi Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = TemplateNotifikasi::where('id',$id);
        $bidangusaha->delete();

        return redirect()
            ->route("template_notifikasi.index")
            ->with("message",(" Notifikasi Berhasil Terhapus"));

    }
}
