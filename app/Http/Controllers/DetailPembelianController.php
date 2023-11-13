<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\PembelianPenerimaan;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DetailPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();

        return view("semua_laporan.detail_pembelian.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //view pembelian penerimaan order by created at desc
        $pembelian = PembelianPenerimaan::orderBy('created_at', 'desc')->get();
        return Datatables::of($pembelian)
            ->editColumn('tanggal_penerimaan', function ($pembelian) {
                return date('d/m/Y', strtotime($pembelian->tanggal_penerimaan));
            })
            //format currency jumlah_tagihan
            ->editColumn('jumlah_tagihan', function ($pembelian) {
                return number_format($pembelian->jumlah_tagihan, 0, ',', '.');
            })
            ->addColumn('details_url', function($customer) {
                return route('detail_pembelian.show', $customer->id);
            })
            ->make(true);
        return view("semua_laporan.detail_pembelian.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DetailPembelian::create($request->all());

        return \redirect()
            ->route("semua_laporan.detail_pembelian.index")
            ->with("success", __("Pengajuan Detail Pembelian Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //data pembelian body , daftar produk , keuangan perpajakan
        $pembelian = DB::table('pembelian_penerimaan')
            ->leftJoin('pembelian_penerimaan_body', 'pembelian_penerimaan.id', '=', 'pembelian_penerimaan_body.pembelian_penerimaan_id')
            ->leftJoin('daftar_produks', 'pembelian_penerimaan_body.produk_id', '=', 'daftar_produks.id')
            ->leftJoin('perpajakan_keuangans', 'pembelian_penerimaan_body.pajak', '=', 'perpajakan_keuangans.id')
            ->leftJoin('satuan_produks', 'daftar_produks.id_satuan', '=', 'satuan_produks.id')
            ->select('daftar_produks.nama_produk','daftar_produks.kode_produk','satuan_produks.satuan_produk','pembelian_penerimaan_body.kuantitas','perpajakan_keuangans.nama_pajak','pembelian_penerimaan_body.diskon','pembelian_penerimaan_body.harga_produk','pembelian_penerimaan_body.total_amount_all')
            ->where('pembelian_penerimaan.id', '=', $id)
            ->get();

        return Datatables::of($pembelian)->make(true);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPembelian $detail_pembelian)
    {
        return view("detail_pembelian.form", \compact("detail_pembelian"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailPembelian $detail_pembelian)
    {
        $detail_pembelian->fill($request->all());

        $detail_pembelian->save();

        return redirect()
            ->route("semua_laporan.detail_pembelian.index")
            ->with("success", __("Perbaharui Detail Pembelian Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPembelian $detail_pembelian)
    {
        //
    }
}
