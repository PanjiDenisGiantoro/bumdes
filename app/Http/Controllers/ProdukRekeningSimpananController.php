<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\AkunPerkiraan;
use App\Models\PemetaanAkun;
use App\Models\ProdukRekeningPembiayaan;
use App\Models\produkRekeningSimpanan;
use Illuminate\Http\Request;

class ProdukRekeningSimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $produk = produkRekeningSimpanan::where('akad_simpanan',$request->id)->where('kategori_produk','=','simpanan')->get();
            return response()->json($produk);
        }
        $produkSimpanans = produkRekeningSimpanan::with('akads','akun_perkiraans')->where('kategori_produk', '=', 'simpanan')->orderBy('created_at','DESC')->paginate(10);
        $produkSimpananberjangkas = produkRekeningSimpanan::with('akads','akun_perkiraans')->where('kategori_produk', '=', 'simpanan-berjangka')->orderBy('created_at','DESC')->paginate(10);
        $produkpembiayaan = ProdukRekeningPembiayaan::with('akads','akun_perkiraans')
            ->orderBy('created_at','DESC')
            ->with('akads')
            ->paginate(10);

        return view("produk-rekening-simpanan.index", compact('produkSimpanans','produkSimpananberjangkas','produkpembiayaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akadList = Akad::all();
        $GLList = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        return view("produk-rekening-simpanan.create",compact('akadList','GLList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'kategori_produk' => 'simpanan'
        ]);
        produkRekeningSimpanan::create($request->except('accounts'));
        return \redirect()
            ->route("produk-simpanan.index")
            ->with("message",("Produk rekening Simpanan Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produkRekeningSimpanan  $produkRekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    // public function show(produkRekeningSimpanan $produkRekeningSimpanan)
    public function show($id)
    {
        $viewMode= true;
        $produk_simpanan = produkRekeningSimpanan::findOrFail($id);
        $akadList = Akad::all();
        $GLList = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        return view("produk-rekening-simpanan.create", compact('produk_simpanan', 'viewMode','akadList','GLList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produkRekeningSimpanan  $produkRekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    // public function edit(produkRekeningSimpanan $produkRekeningSimpanan)
    public function edit($id)
    {
        // dd($produkRekeningSimpanan);
        $produk_simpanan = produkRekeningSimpanan::findOrFail($id);
        $GLList = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        $akadList = Akad::all();

        return view("produk-rekening-simpanan.create", compact('produk_simpanan','GLList','akadList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\produkRekeningSimpanan  $produkRekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produkRekeningSimpanan $produkRekeningSimpanan)
    {
        $produkSimpanan = produkRekeningSimpanan::find($request->id);
        $produkSimpanan->fill($request->except('accounts'));
        $produkSimpanan->save();

        return redirect()
            ->route("produk-simpanan.index")
            ->with("message",(" Produk Rekening Simpanan Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produkRekeningSimpanan  $produkRekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(produkRekeningSimpanan $produkRekeningSimpanan)
    {
        //
    }
}
