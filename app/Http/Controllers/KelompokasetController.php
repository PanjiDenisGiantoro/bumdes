<?php

namespace App\Http\Controllers;

use App\Models\KelompokAset;
use Illuminate\Http\Request;

class KelompokasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templatewa = KelompokAset::orderBy('created_at', 'DESC')->paginate(10);
        return view('tetapan.kelompok_aset.index',compact('templatewa'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kelompok_aset.form");

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
            'kelompok_aset' => 'required|unique:kelompok_asets|max:255',
        ]);
        KelompokAset::create($request->all());
        return \redirect()
            ->route("kelompok_aset.index")
            ->with("message",("Kelompok Aset Berhasil Terdaftar"));
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
        $template_wa = KelompokAset::where('id',$id)->first();

        return view("tetapan.kelompok_aset.form", \compact("template_wa"));

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
        $template_wa = KelompokAset::find($id);

        $template_wa->fill($request->all());

        $template_wa->save();

        return redirect()
            ->route("kelompok_aset.index")
            ->with("message", ("Kelompok Aset Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidangusaha = KelompokAset::where('id',$id);
        $bidangusaha->delete();
        return \redirect()
            ->route("kelompok_aset.index")
            ->with("message", ("  Kelompok Aset Berhasil"));

    }
}
