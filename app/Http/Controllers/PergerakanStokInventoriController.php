<?php

namespace App\Http\Controllers;

use App\Models\PenomoranAuto;
use App\Models\PergerakanStokInventori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PergerakanStokInventoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tetapans = Tetapan::paginate();


        return view("semua_laporan.pergerakan_stok_inventori.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventory = DB::table('daftar_produks')
            ->leftJoin('pengiriman_bodies','daftar_produks.id','=','pengiriman_bodies.id_produk')
            ->leftJoin('pembelian_penerimaan_body','daftar_produks.id','=','pembelian_penerimaan_body.produk_id')
            ->selectRaw('sum(pengiriman_bodies.qty) as jual,sum(pembelian_penerimaan_body.kuantitas) as beli,(sum(pengiriman_bodies.qty) + sum(pembelian_penerimaan_body.kuantitas)) as total,nama_produk,harga_beli,stok,daftar_produks.id,kode_produk,harga_anggota')
            ->groupBy('daftar_produks.id')
            ->get();
        return Datatables::of($inventory)
            ->addColumn('details_url', function($customer) {
                return route('pergerakan_stok_inventori.show', $customer->id);
            })
            ->make(true);
        return view("semua_laporan.pergerakan_stok_inventori.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PergerakanStokInventori::create($request->all());

        return \redirect()
            ->route("semua_laporan.pergerakan_stok_inventori.index")
            ->with("success", __("Pengajuan Pergerakan Stok Inventori Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $daftar_inventory = DB::table('pengiriman_bodies')
            ->leftJoin('pengirimans','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
            ->leftJoin('daftar_produks','daftar_produks.id','=','pengiriman_bodies.id_produk')
            ->where('id_produk',$id)
            ->selectRaw("id_produk,no_pengiriman,nama_produk,qty,stok,pengirimans.created_at,stok_berkurang,pengirimans.id,pengirimans.non_anggota");
        $daftar_inventory_pemebelian = DB::table('pembelian_pembayaran_body')
            ->join('pembelian_pembayaran','pembelian_pembayaran_body.id_pembelian_pembayaran','=','pembelian_pembayaran.id')
            ->join('daftar_produks','daftar_produks.id','=','pembelian_pembayaran_body.produk')
            ->where('produk',$id)
            ->selectRaw("produk,invoice,nama_produk,pembelian_pembayaran_body.qty,pembelian_pembayaran_body.stok,pembelian_pembayaran.created_at,stok_bertambah,pembelian_pembayaran.id,supplier")
            ->union($daftar_inventory)->orderBy('created_at','desc');
        $headpembelian = PenomoranAuto::Pembelian()->first();
        $headpemnjualan = PenomoranAuto::Penjualan()->first();
        return Datatables::of($daftar_inventory_pemebelian)
            //format tanggal
            ->editColumn('created_at', function ($pengiriman) {
                return date('d/m/Y', strtotime($pengiriman->created_at));
            })
            //edit string @if(substr($pengiriman->invoice,0,1) == substr($headpembelian->head,0,1))
            ->editColumn('invoice', function ($pengiriman) use ($headpembelian) {
                if(substr($pengiriman->invoice,0,1) == substr($headpembelian->head,0,1)){
                    return 'Tagihan Pembelian';
                }else{
                    return 'Tagihan Penjualan';
                }
            })
            //string deskripsi supplier dan invoice digabung
            ->editColumn('supplier', function ($pengiriman) use ($headpembelian) {
                    return $pengiriman->invoice.' - '.$pengiriman->supplier;
            })
            //@if(substr($inven->invoice,0,1) == substr($headpembelian->head,0,1)) dan td warna


            ->editColumn('stok_bertambah', function ($pengiriman) use ($headpembelian) {
                if(substr($pengiriman->invoice,0,1) == substr($headpembelian->head,0,1)){
                    return '+'.$pengiriman->qty;
                }else{
                    return '-'.$pengiriman->qty;
                }
            })



            ->make(true);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(PergerakanStokInventori $pergerakan_stok_inventori)
    {
        return view("pergerakan_stok_inventori.form", \compact("pergerakan_stok_inventori"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PergerakanStokInventori $pergerakan_stok_inventori)
    {
        $pergerakan_stok_inventori->fill($request->all());

        $pergerakan_stok_inventori->save();

        return redirect()
            ->route("pergerakan_stok_inventori.index")
            ->with("success", __("Perbaharui Kode Perusahaan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PergerakanStokInventori $pergerakan_stok_inventori)
    {
        //
    }
}
