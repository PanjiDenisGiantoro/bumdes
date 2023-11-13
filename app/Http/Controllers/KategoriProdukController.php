<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KategoriProduk = KategoriProduk::orderBy('created_at', 'DESC')->paginate(10);

        return view("setting_produk.kategori_produk.index",compact('KategoriProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_produk.kategori_produk.form");
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
            'kategori_produk' => 'required|unique:kategori_produks|max:255',
        ]);
        KategoriProduk::create($request->all());

        return \redirect()
            ->route("kategori_produk.index")
            ->with("message",("Kategori Produk Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriProduk $kategori_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriProduk $request,$id)
    {
        $kategori_produk = KategoriProduk::where('id',$id)->first();

        return view("setting_produk.kategori_produk.form", \compact("kategori_produk"));
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
        $kategori_produk = KategoriProduk::find($id);

        $kategori_produk->fill($request->all());

        $kategori_produk->save();

        return redirect()
            ->route("kategori_produk.index")
            ->with("message",(" Kategori Produk Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $KategoriProduk = KategoriProduk::where('id',$id);
        $KategoriProduk->delete();
        return redirect()
            ->route("kategori_produk.index")
            ->with("message",(" Kategori Produk Berhasil Terhapus"));

    }
}
