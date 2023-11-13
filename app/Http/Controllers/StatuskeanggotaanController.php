<?php

namespace App\Http\Controllers;

use App\Models\StatusKeanggotaan;
use Illuminate\Http\Request;

class StatuskeanggotaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status_keanggotaan = StatusKeanggotaan::orderBy('created_at', 'DESC')->paginate(10);
        return view("tetapan.status_keanggotaan.index",compact('status_keanggotaan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tetapan.status_keanggotaan.form");

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
            'status_keanggotaan' => 'required|unique:status_keanggotaan|max:255',
        ]);
        StatusKeanggotaan::create($request->all());

        return \redirect()
            ->route("status_keanggotaan.index")
            ->with("message",(" Kategori Keanggotaan Berhasil Terdaftar"));
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
        $status_keanggotaan = StatusKeanggotaan::where('id',$id)->first();
        return view("tetapan.status_keanggotaan.form", \compact("status_keanggotaan"));

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
        $status_keanggotaan = StatusKeanggotaan::find($id);

        $status_keanggotaan->fill($request->all());

        $status_keanggotaan->save();

        return redirect()
            ->route("status_keanggotaan.index")
            ->with("message",(" Kategori Keanggotaan Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidangusaha = StatusKeanggotaan::where('id',$id);
        $bidangusaha->delete();

        return redirect()
            ->route("status_keanggotaan.index")
            ->with("message",(" Kategori Keanggotaan Berhasil Terhapus"));

    }
}
