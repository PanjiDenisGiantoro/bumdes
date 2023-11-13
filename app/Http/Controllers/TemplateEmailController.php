<?php

namespace App\Http\Controllers;

use App\Models\TemplateEmail;
use Illuminate\Http\Request;
use SebastianBergmann\Template\Template;

class TemplateEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templateemail = TemplateEmail::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.template_email.index",compact('templateemail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.template_email.form");
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
            'template_email' => 'required|unique:template_emails|max:255',
        ]);
        TemplateEmail::create($request->all());

        return \redirect()
            ->route("template_email.index")
            ->with("message",(" Template Email Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateEmail $template_email)
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
        $template_email = TemplateEmail::where('id',$id)->first();
        return view("tetapan.template_email.form", \compact("template_email"));
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
        $template_email = TemplateEmail::find($id);

        $template_email->fill($request->all());

        $template_email->save();

        return redirect()
            ->route("template_email.index")
            ->with("message",(" Template email Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $bidangusaha = TemplateEmail::where('id',$id);
        $bidangusaha->delete();

        return redirect()
            ->route("template_email.index")
            ->with("message",(" Template email Berhasil Terhapus"));

    }
}
