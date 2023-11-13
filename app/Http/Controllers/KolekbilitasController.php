<?php

namespace App\Http\Controllers;

use App\Models\Kolekbilitas;
use Illuminate\Http\Request;

class KolekbilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kolektibilitas = Kolekbilitas::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.kolektibilitas.index",compact('kolektibilitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.kolektibilitas.form");

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
            'status_kolek' => 'required|unique:kolektibilitas|max:255',
        ]);
        Kolekbilitas::create($request->all());
        return \redirect()
            ->route("kolektibilitas.index")
            ->with("message", ("  Kolektibilitas Berhasil Terdaftar"));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kolekbilitas  $kolekbilitas
     * @return \Illuminate\Http\Response
     */
    public function show(Kolekbilitas $kolekbilitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kolekbilitas  $kolekbilitas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kolektibilitas = Kolekbilitas::where('id',$id)->first();

        return view("tetapan.kolektibilitas.form", \compact("kolektibilitas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kolekbilitas  $kolekbilitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $akad = Kolekbilitas::find($id);
        $akad->fill($request->all());
        $akad->save();
        return redirect()
            ->route("kolektibilitas.index")
            ->with("message",(" Kolektibilitas Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kolekbilitas  $kolekbilitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $kolektibilitas = Kolekbilitas::where('id',$id);
        $kolektibilitas->delete();
        return redirect()
            ->route("kolektibilitas.index")
            ->with("message",(" Kolektibilitas Berhasil Terhapus"));

    }
}
