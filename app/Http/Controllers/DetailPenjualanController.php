<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Order;
use App\Models\PemesananPenjualan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();
        $pengiriman_bodies = DB::table('pengirimans')
            ->leftJoin('pemesanan_penjualans', 'pengirimans.no_pemesanan', '=', 'pemesanan_penjualans.id')
            ->leftJoin('pemesanan_penjualan_bodies', 'pemesanan_penjualan_bodies.id_pemesanan', '=', 'pemesanan_penjualans.id')
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pemesanan_penjualan_bodies.id_produk')
            ->leftJoin('satuan_produks', 'satuan_produks.id', '=', 'daftar_produks.id_satuan')
            ->where('pengirimans.id','=',48)->get();


        $penjualan = PemesananPenjualan::with('anggotas')->paginate(10);
        return view("semua_laporan.detail_penjualan.index",compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengiriman = Pengiriman::all();
        return Datatables::of($pengiriman)
            ->editColumn('tanggal_pengiriman', function ($pengiriman) {
                return date('d/m/Y', strtotime($pengiriman->tanggal_pengiriman));
            })
            ->addColumn('details_url', function($customer) {
                return route('detail_penjualan.show', $customer->id);
            })
            ->make(true);
        return view("semua_laporan.detail_penjualan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DetailPenjualan::create($request->all());

        return \redirect()
            ->route("semua_laporan.detail_penjualan.index")
            ->with("success", __("Pengajuan Detail Penjualan Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        $pengiriman_bodies = DB::table('pengirimans')
            ->leftJoin('pemesanan_penjualans', 'pengirimans.no_pemesanan', '=', 'pemesanan_penjualans.id')
            ->leftJoin('pemesanan_penjualan_bodies', 'pemesanan_penjualan_bodies.id_pemesanan', '=', 'pemesanan_penjualans.id')
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pemesanan_penjualan_bodies.id_produk')
            ->leftJoin('satuan_produks', 'satuan_produks.id', '=', 'daftar_produks.id_satuan')
            ->leftJoin('perpajakan_keuangans', 'perpajakan_keuangans.id', '=', 'pemesanan_penjualan_bodies.pajak')
            ->where('pengirimans.id','=',$id);

        return Datatables::of($pengiriman_bodies)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPenjualan $detail_penjualan)
    {
        return view("detail_penjualan.form", \compact("detail_penjualan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailPenjualan $detail_penjualan)
    {
        $detail_penjualan->fill($request->all());

        $detail_penjualan->save();

        return redirect()
            ->route("semua_laporan.detail_penjualan.index")
            ->with("success", __("Perbaharui Detail Penjualan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPenjualan $detail_penjualan)
    {
        //
    }
}
