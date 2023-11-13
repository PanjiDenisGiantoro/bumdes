<?php

namespace App\Http\Controllers;

use App\Models\TagihanVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembeliantagihan = DB::table('pembelian_penerimaan_body')
            ->leftJoin('pembelian_penerimaan','pembelian_penerimaan_body.pembelian_penerimaan_id','=','pembelian_penerimaan.pesananpembelian_id')
            ->leftJoin('pembelian_pembayaran','pembelian_pembayaran.id','=','pembelian_penerimaan.pesananpembelian_id')
            ->leftJoin('pesanan_pembelian','pesanan_pembelian.id','=','pembelian_penerimaan.pesananpembelian_id')
            ->leftJoin('daftar_produks','daftar_produks.id','=','pembelian_penerimaan_body.produk_id')
            ->leftJoin('supplier','supplier.nama','=','pembelian_penerimaan.supplier')
            ->selectRaw('no_pesanan,pembelian_pembayaran.supplier,pembelian_penerimaan.tanggal_penerimaan,sum(pembelian_pembayaran.jumlah_tagihan) as jumlah,sum(pembelian_pembayaran.jumlah_bayar) as bayar, sum(pembelian_pembayaran.sisa_tagihan) as sisa, status_pembayaran')
            ->where('status_pembayaran','=','Belum bayar')
            ->orWhere('status_pembayaran','=','Belum Lunas')
            ->groupBy('pembelian_penerimaan.id')
            ->orderBy('pembelian_pembayaran.created_at','DESC')
            ->paginate(10);
        return view("semua_laporan.tagihan_vendor.index",compact('pembeliantagihan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.tagihan_vendor.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TagihanVendor::create($request->all());

        return \redirect()
            ->route("semua_laporan.tagihan_vendor.index")
            ->with("success", __("Pengajuan Tagihan Vendor Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(TagihanVendor $tagihan_vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(TagihanVendor $tagihan_vendor)
    {
        return view("tagihan_vendor.form", \compact("tagihan_vendor"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagihanVendor $tagihan_vendor)
    {
        $tagihan_vendor->fill($request->all());

        $tagihan_vendor->save();

        return redirect()
            ->route("tagihan_vendor.index")
            ->with("success", __("Perbaharui Tagihan Vendor Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagihanVendor $tagihan_vendor)
    {
        //
    }
}
