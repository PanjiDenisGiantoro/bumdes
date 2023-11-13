<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumber_dana = SumberDana::orderBy('created_at', 'DESC')->paginate(10);

        return view("tetapan.sumber_dana.index",compact('sumber_dana'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.sumber_dana.form");

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
            'nama_sumber_dana' => 'required|unique:sumber_danas|max:255',
        ]);
        SumberDana::create($request->all());

        return \redirect()
            ->route("sumber_dana.index")
            ->with("message",(" Sumber Dana Berhasil Terdaftar"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SumberDana  $sumberDana
     * @return \Illuminate\Http\Response
     */
    public function show(SumberDana $sumberDana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SumberDana  $sumberDana
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sumber_dana = SumberDana::where('id',$id)->first();

        return view("tetapan.sumber_dana.form", \compact("sumber_dana"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SumberDana  $sumberDana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $sumber_dana = SumberDana::find($id);

        $sumber_dana->fill($request->all());

        $sumber_dana->save();

        return redirect()
            ->route("sumber_dana.index")
            ->with("message",(" Sumber Dana Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SumberDana  $sumberDana
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sumber_dana = SumberDana::where('id',$id);
        $sumber_dana->delete();
        return redirect()
            ->route("sumber_dana.index")
            ->with("message",(" Sumber Dana Berhasil Terhapus"));

    }
}
