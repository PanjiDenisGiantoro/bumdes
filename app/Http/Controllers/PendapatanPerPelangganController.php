<?php

namespace App\Http\Controllers;

use App\Models\PendapatanPerPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PendapatanPerPelangganController extends Controller
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
            ->leftJoin('pengiriman_bodies','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
            ->leftJoin('daftar_warungs','daftar_warungs.id_anggota','=','pengirimans.id_pelanggan')
            ->selectRaw('no_pengiriman,non_anggota,nama_warung,count(pengirimans.id) as jumlah,sum(pengirimans.total) as total')
            ->groupBy('pengirimans.non_anggota')
            ->paginate(10);

        return view("semua_laporan.pendapatan_per_pelanggan.index",compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = DB::table('pengirimans')
            ->leftJoin('pengiriman_bodies','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
            ->leftJoin('daftar_warungs','daftar_warungs.id_anggota','=','pengirimans.id_pelanggan')
            ->selectRaw('pengirimans.id,no_pengiriman,non_anggota,nama_warung,count(pengirimans.id) as jumlah,sum(pengirimans.total) as total')
            ->groupBy('pengirimans.non_anggota')
            ->get();
        return Datatables::of($list)
            ->addColumn('details_url', function($customer) {
                return route('detail_penjualan.show', $customer->id);
            })
            ->make(true);
        return view("semua_laporan.detail_penjualan.form");
        return view("semua_laporan.pendapatan_per_pelanggan.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PendapatanPerPelanggan::create($request->all());

        return \redirect()
            ->route("semua_laporan.pendapatan_per_pelanggan.index")
            ->with("success", __("Pengajuan Pendapatan Per Pelanggan Berhasil"));
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
    public function edit(PendapatanPerPelanggan $pendapatan_per_pelanggan)
    {
        return view("pendapatan_per_pelanggan.form", \compact("pendapatan_per_pelanggan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PendapatanPerPelanggan $pendapatan_per_pelanggan)
    {
        $pendapatan_per_pelanggan->fill($request->all());

        $pendapatan_per_pelanggan->save();

        return redirect()
            ->route("pendapatan_per_pelanggan.index")
            ->with("success", __("Perbaharui Pendapatan Per Pelanggan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PendapatanPerPelanggan $pendapatan_per_pelanggan)
    {
        //
    }
}
