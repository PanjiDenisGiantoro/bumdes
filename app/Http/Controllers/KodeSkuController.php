<?php

namespace App\Http\Controllers;

use App\Models\KodeSku;
use Illuminate\Http\Request;

class KodeSkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $KodeSku = KodeSku::orderBy('created_at', 'DESC')->paginate(10);
        return view("setting_produk.kode_sku.index",compact('KodeSku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("setting_produk.kode_sku.form");
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
            'sku' => 'required|unique:kode_skus|max:255',
        ]);
        KodeSku::create($request->all());

        return \redirect()
            ->route("kode_sku.index")
            ->with("message",("  SKU Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeSku $kode_sku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeSku $request,$id)
    {
        $kode_sku = KodeSku::where('id',$id)->first();
        return view("setting_produk.kode_sku.form", \compact("kode_sku"));
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
        $kode_sku = KodeSku::find($id);

        $kode_sku->fill($request->all());

        $kode_sku->save();

        return redirect()
            ->route("kode_sku.index")
            ->with("message",(" SKU Berhasil Terupdate"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodeSku $request,$id)
    {
        $KategoriProduk = KodeSku::where('id',$id);
        $KategoriProduk->delete();
        return redirect()
            ->route("kode_sku.index")
            ->with("message",(" SKU Berhasil Terhapus"));

    }
}
