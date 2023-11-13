<?php

namespace App\Http\Controllers;

use App\Models\BeratSatuan;
use Illuminate\Http\Request;

class BeratSatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $BeratSatuan = BeratSatuan::paginate(10)->orderBy('id', 'DESC');

        return view("setting_produk.beratsatuan_produk.index",compact('BeratSatuan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_produk.beratsatuan_produk.form");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        BeratSatuan::create($request->all());

        return \redirect()
            ->route("berat_satuan.index")
            ->with("message",("Berat Satuan Berhasil Terdaftar"));

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
        $BeratSatuan = BeratSatuan::where('id',$id)->first();

        return view("setting_produk.beratsatuan_produk.form", \compact("BeratSatuan"));

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
        $kategori_produk = BeratSatuan::find($id);

        $kategori_produk->fill($request->all());

        $kategori_produk->save();

        return redirect()
            ->route("berat_satuan.index")
            ->with("message",(" Berat Satuan Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $KategoriProduk = BeratSatuan::where('id',$id);
        $KategoriProduk->delete();
        return redirect()
            ->route("berat_satuan.index")
            ->with("message",(" Berat Satuan Berhasil Terhapus"));


    }
}
