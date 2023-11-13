<?php

namespace App\Http\Controllers;

use App\Models\TutupBuku;
use Illuminate\Http\Request;

class TutupBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $daftar_pembiayaans = TutupBuku::paginate();

        return view("tutup_buku.index");
         // \compact("tutup_bukus"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tutup_buku.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TutupBuku::create($request->all());

        return redirect()
            ->route("tutup_buku.index")
            ->with("success", __("Pengajuan Tutup buku Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(TutupBuku $tutup_buku)
    {
        //
        return view("tutup_buku.show", \compact("tutup_buku"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(TutupBuku $tutup_buku)
    {
        return view("tutup_buku.edit", \compact("tutup_buku"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TutupBuku $tutup_buku)
    {
        $tutup_buku->fill($request->all());

        $tutup_buku->save();

        return redirect()
            ->route("tutup_buku.index")
            ->with("success", __("Perbaharui Tutup Buku Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(TutupBuku $tutup_buku)
    {
        //
    }
}
