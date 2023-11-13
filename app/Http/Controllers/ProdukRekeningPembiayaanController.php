<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\ProdukRekeningPembiayaan;
use App\Models\produkRekeningSimpanan;
use Illuminate\Http\Request;

class ProdukRekeningPembiayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $produkPembiayaan = ProdukRekeningPembiayaan::filter($request->all())->get();
            // $produkPembiayaan->map(function ($a, $i) {
            //     $a->text = $a->nama_pembiayaan;
            // });

            return response()->json(['result' => $produkPembiayaan]);
        }

        return view("produk-rekening-pembiayaan.index");

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
        return view("produk-rekening-pembiayaan.create",compact('akadList','GLList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->merge([
            'kategori_produk' => 'pembiayaan'
        ]);
        ProdukRekeningPembiayaan::create($request->except('_token'));
        return \redirect()
            ->route("produk-simpanan.index")
            ->with("message",("Produk rekening Pembiayaan Berhasil Terdaftar"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukRekeningPembiayaan  $produkRekeningPembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewMode= true;
        $produk_pembiayaan = ProdukRekeningPembiayaan::findOrFail($id);

        $akadList = Akad::all();
        $GLList = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        return view("produk-rekening-pembiayaan.create", compact('produk_pembiayaan', 'viewMode','akadList','GLList'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdukRekeningPembiayaan  $produkRekeningPembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk_pembiayaan = ProdukRekeningPembiayaan::findOrFail($id);

        $akadList = Akad::all();
        $GLList = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();
        return view("produk-rekening-pembiayaan.create", compact('produk_pembiayaan', 'akadList','GLList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdukRekeningPembiayaan  $produkRekeningPembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produkPembiayaan = ProdukRekeningPembiayaan::where('id', '=', $id)->first();

        $produkPembiayaan->update($request->except([
            'akad_pembiayaan',
            'kode_pembiayaan',
        ]));

        return redirect()
            ->route('produk-pembiayaan.show', $id)
            ->with("message",("Produk Rekening Pembiayaan berhasil diubah"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukRekeningPembiayaan  $produkRekeningPembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukRekeningPembiayaan $produkRekeningPembiayaan)
    {
        //
    }
}
