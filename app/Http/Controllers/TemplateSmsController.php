<?php

namespace App\Http\Controllers;

use App\Models\TemplateSms;
use Illuminate\Http\Request;

class TemplateSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templatesms = TemplateSms::orderBy('created_at', 'DESC')->paginate(10);

        return view("tetapan.template_sms.index",compact('templatesms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.template_sms.form");
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
            'template_sms' => 'required|unique:template_sms|max:255',
        ]);
        TemplateSms::create($request->all());

        return \redirect()
            ->route("template_sms.index")
            ->with("message",(" Template SMS Berhasil Terdaftar"));
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
        $template_sms = TemplateSms::where('id',$id)->first();

        return view("tetapan.template_sms.form", \compact("template_sms"));
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
        $template_sms = TemplateSms::find($id);

        $template_sms->fill($request->all());

        $template_sms->save();

        return redirect()
            ->route("template_sms.index")
            ->with("message", (" Template SMS Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = TemplateSms::where('id',$id);
        $bidangusaha->delete();
        return redirect()
            ->route("template_sms.index")
            ->with("message", (" Template SMS Berhasil Terhapus"));
    }
}
