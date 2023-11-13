<?php

namespace App\Http\Controllers;

use App\Models\TemplateWa;
use Illuminate\Http\Request;

class TemplateWaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $templatewa = TemplateWa::orderBy('created_at', 'DESC')->paginate(10);

        return view("tetapan.template_wa.index",compact('templatewa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.template_wa.form");
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
            'template_watsapp' => 'required|unique:template_was|max:255',
        ]);
        TemplateWa::create($request->all());

        return \redirect()
            ->route("template_wa.index")
            ->with("message", (" Template WA Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateWa $template_wa)
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
        $template_wa = TemplateWa::where('id',$id)->first();

        return view("tetapan.template_wa.form", \compact("template_wa"));
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
        $template_wa = TemplateWa::find($id);

        $template_wa->fill($request->all());

        $template_wa->save();

        return redirect()
            ->route("template_wa.index")
            ->with("message",(" Template WA Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = TemplateWa::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("template_wa.index")
            ->with("message",(" Template WA Berhasil Terhapus"));

    }
}
