<?php

namespace App\Http\Controllers;

use App\Models\DaftarKontak;
use App\Models\TipeKontak;
use Illuminate\Http\Request;

class DaftarKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftar_kontaks = DaftarKontak::orderBy('created_at', 'DESC')->paginate(10);

        return view("daftar_kontak.index",compact('daftar_kontaks'));
         // \compact("daftar_kontaks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $TipeKontak = TipeKontak::pluck('tipe_kontak', 'id');

        return view("daftar_kontak.form",compact('TipeKontak'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DaftarKontak::create($request->all());

        return redirect()
            ->route("daftar_kontak.index")
            ->with("message",(" Daftar Kontak Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daftar Kontak  $Daftar Kontak
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarKontak  $request,$id)
    {
        //
        $daftar_kontaks = DaftarKontak::where('id',$id)->first();

        return view("daftar_kontak.show", \compact("daftar_kontaks"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daftar Kontak  $Daftar Kontak
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarKontak $request,$id)
    {
        $daftar_kontak = DaftarKontak::where('id',$id)->first();
        $TipeKontak = TipeKontak::pluck('tipe_kontak', 'id');

        return view("daftar_kontak.edit", \compact("daftar_kontak",'TipeKontak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Daftar Kontak  $Daftar Kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $daftar_kontak = DaftarKontak::find($id);

        $daftar_kontak->fill($request->all());

        $daftar_kontak->save();

        return redirect()
            ->route("daftar_kontak.index")
            ->with("message",(" Daftar Kontak Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daftar Kontak  $Daftar Kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $KategoriProduk = DaftarKontak::where('id',$id);
        $KategoriProduk->delete();
//        return redirect()
//            ->route("daftar_kontak.index")
//            ->with("success", __("Daftar Kontak Berhasil Di Hapus"));
////
    }
}
