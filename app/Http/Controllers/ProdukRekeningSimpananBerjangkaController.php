<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\produkRekeningSimpanan;
use App\Models\ProdukRekeningSimpananBerjangka;
use App\Models\Rekening;
use App\Models\RekeningSimpanan;
use Illuminate\Http\Request;

class ProdukRekeningSimpananBerjangkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            if ($request->query('akad_id') == true) {

                $simjaka = produkRekeningSimpanan::where('kategori_produk', '=', 'simpanan-berjangka')
                    ->where('status','=','1')
                    ->where('akad_simpanan', '=', $request->akad_id)
                    ->get();
                if ($request->anggota_id){
                    $simpanan = RekeningSimpanan::with('produk')->where('anggota_id','=',$request->anggota_id)
                        ->where('status', 'aktif')
                        ->get();
                    return response()->json(['results' => $simjaka, 'simpanan' => $simpanan]);
                }else{
                    return response()->json(['results' => $simjaka]);
                }

            }

            $List_anggota = Anggota::where('id',$request->id)->first();

            return response()->json(['results' => $List_anggota]);
        }
        return view("produk-rekening-simpanan-berjangka.index");

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
        return view("produk-rekening-simpanan-berjangka.create",compact('akadList','GLList'));

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
            'kategori_produk' => 'simpanan-berjangka'
        ]);
        produkRekeningSimpanan::create($request->except('accounts'));
        return \redirect()
            ->route("produk-simpanan.index")
            ->with("message",("Produk rekening Simpanan Berjangka Berhasil Terdaftar"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukRekeningSimpananBerjangka  $produkRekeningSimpananBerjangka
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewMode= true;
        $produk_simpanan = produkRekeningSimpanan::findOrFail($id);
        $akadList = Akad::all();
        $GLList = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        return view("produk-rekening-simpanan-berjangka.create", compact('produk_simpanan', 'viewMode','akadList','GLList'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdukRekeningSimpananBerjangka  $produkRekeningSimpananBerjangka
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk_simpanan = produkRekeningSimpanan::findOrFail($id);
        $GLList = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        $akadList = Akad::all();

        return view("produk-rekening-simpanan-berjangka.create", compact('produk_simpanan','GLList','akadList'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdukRekeningSimpananBerjangka  $produkRekeningSimpananBerjangka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $produkSimpanan = ProdukRekeningSimpanan::find($id);
        $produkSimpanan->fill($request->except('accounts'));
        $produkSimpanan->save();
        return redirect()
            ->route("produk-simpanan.index")
            ->with("message",(" Produk Rekening Simpanan Berjangka Berhasil Terupdate"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukRekeningSimpananBerjangka  $produkRekeningSimpananBerjangka
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukRekeningSimpananBerjangka $produkRekeningSimpananBerjangka)
    {
        //
    }
}
