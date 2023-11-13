<?php

namespace App\Http\Controllers;

use App\Models\GudangProduk;
use Illuminate\Http\Request;

class GudangProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $GudangProduk = GudangProduk::orderBy('created_at', 'DESC')->paginate(10);
        return view("setting_produk.gudang_produk.index",compact('GudangProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_produk.gudang_produk.form");
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
            'gudang_produk' => 'required|unique:gudang_produks|max:255',
        ]);
        GudangProduk::create($request->all());


        return \redirect()
            ->route("gudang_produk.index")
            ->with("message",(" Gudang Produk Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(GudangProduk $gudang_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(GudangProduk $request,$id)
    {
        $gudang_produk = GudangProduk::where('id',$id)->first();

        return view("setting_produk.gudang_produk.form", \compact("gudang_produk"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $gudang_produk = GudangProduk::find($id);

        $gudang_produk->fill($request->all());

        $gudang_produk->save();

        return redirect()
            ->route("gudang_produk.index")
            ->with("message",(" Gudang Produk Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $KategoriProduk = GudangProduk::where('id',$id);
        $KategoriProduk->delete();
        return redirect()
            ->route("gudang_produk.index")
            ->with("message",(" Gudang Produk Berhasil Terhapus"));
    }
}
