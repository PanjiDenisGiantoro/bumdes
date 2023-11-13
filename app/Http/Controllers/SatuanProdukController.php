<?php

namespace App\Http\Controllers;

use App\Models\SatuanProduk;
use Illuminate\Http\Request;

class SatuanProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SatuanProduk = SatuanProduk::orderBy('created_at', 'DESC')->paginate(10);
        return view("setting_produk.satuan_produk.index",compact('SatuanProduk'));
         // \compact("satuan_produks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_produk.satuan_produk.form");
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
            'satuan_produk' => 'required|unique:satuan_produks|max:255',
        ]);
        SatuanProduk::create($request->all());

        return redirect()
            ->route("satuan_produk.index")
            ->with("message",(" Satuan Produk Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(SatuanProduk $satuan_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(SatuanProduk $request,$id)
    {
        $satuan_produk = SatuanProduk::where('id',$id)->first();

        return view("setting_produk.satuan_produk.form", \compact("satuan_produk"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $satuan_produk = SatuanProduk::find($id);

        $satuan_produk->fill($request->all());

        $satuan_produk->save();

        return redirect()
            ->route("satuan_produk.index")
            ->with("message",(" Satuan Produk Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $SatuanProduk = SatuanProduk::where('id',$id);
        $SatuanProduk->delete();
        return \redirect()
            ->route("satuan_produk.index")
            ->with("message", (" Satuan Produk Berhasil Terhapus"));

    }
}
