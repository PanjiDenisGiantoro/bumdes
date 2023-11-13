<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\PengirimanBody;
use App\Models\PenjualanPerProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PenjualanPerProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        $list = DB::table('pengirimans')
            ->join('pengiriman_bodies','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
            ->selectRaw('sum(pengiriman_bodies.qty) as jumlah_qty,sum(pengiriman_bodies.total_amount_all) as total,pengiriman_bodies.id_produk,pengirimans.id,harga_produk,nama_produk,kode_produk')
            ->groupBy('pengiriman_bodies.id_produk')
            ->get();

        return view("semua_laporan.penjualan_per_produk.index",compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = DB::table('pengirimans')
            ->join('pengiriman_bodies','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
            ->selectRaw('sum(pengiriman_bodies.qty) as jumlah_qty,sum(pengiriman_bodies.total_amount_all) as total,pengiriman_bodies.id_produk,daftar_produks.id,harga_produk,nama_produk,kode_produk')
            ->groupBy('pengiriman_bodies.id_produk')
            ->get();

        return Datatables::of($list)
            ->addColumn('details_url', function($customer) {
                return route('penjualan_per_produk.show', $customer->id);
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PenjualanPerProduk::create($request->all());

        return \redirect()
            ->route("semua_laporan.penjualan_per_produk.index")
            ->with("success", __("Pengajuan Penjualan Per Produk Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = DB::table('pengirimans')
            ->leftJoin('pemesanan_penjualans', 'pengirimans.no_pemesanan', '=', 'pemesanan_penjualans.id')
            ->leftJoin('pemesanan_penjualan_bodies', 'pemesanan_penjualan_bodies.id_pemesanan', '=', 'pemesanan_penjualans.id')
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pemesanan_penjualan_bodies.id_produk')
            ->leftJoin('satuan_produks', 'satuan_produks.id', '=', 'daftar_produks.id_satuan')
            ->leftJoin('perpajakan_keuangans', 'perpajakan_keuangans.id', '=', 'pemesanan_penjualan_bodies.pajak')
            ->where('daftar_produks.id','=',$id);

        return Datatables::of($produk)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PenjualanPerProduk $penjualan_per_produk)
    {
        return view("penjualan_per_produk.form", \compact("penjualan_per_produk"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenjualanPerProduk $penjualan_per_produk)
    {
        $penjualan_per_produk->fill($request->all());

        $penjualan_per_produk->save();

        return redirect()
            ->route("penjualan_per_produk.index")
            ->with("success", __("Perbaharui Penjualan Per Produk Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenjualanPerProduk $penjualan_per_produk)
    {
        //
    }
}
