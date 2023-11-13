<?php

namespace App\Http\Controllers;

use App\Models\PembelianPerVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianPerVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembeliansupplier = DB::table('pembelian_penerimaan_body')
            ->leftJoin('pembelian_penerimaan','pembelian_penerimaan_body.pembelian_penerimaan_id','=','pembelian_penerimaan.pesananpembelian_id')
            ->leftJoin('daftar_produks','daftar_produks.id','=','pembelian_penerimaan_body.produk_id')
            ->leftJoin('supplier','supplier.nama','=','pembelian_penerimaan.supplier')
            ->selectRaw('count(pembelian_penerimaan_id) as jumlah,supplier,id_supplier,sum(jumlah_tagihan) as tagihan')
            ->groupBy('supplier')
            ->paginate(10);
        return view("semua_laporan.pembelian_per_vendor.index",compact('pembeliansupplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.pembelian_per_vendor.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PembelianPerVendor::create($request->all());

        return \redirect()
            ->route("semua_laporan.pembelian_per_vendor.index")
            ->with("success", __("Pengajuan Pembelian Per Vendor Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(PembelianPerVendor $pembelian_per_vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PembelianPerVendor $pembelian_per_vendor)
    {
        return view("pembelian_per_vendor.form", \compact("pembelian_per_vendor"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembelianPerVendor $pembelian_per_vendor)
    {
        $pembelian_per_vendor->fill($request->all());

        $pembelian_per_vendor->save();

        return redirect()
            ->route("pembelian_per_vendor.index")
            ->with("success", __("Perbaharui Pembelian Per Vendor Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembelianPerVendor $pembelian_per_vendor)
    {
        //
    }
}
