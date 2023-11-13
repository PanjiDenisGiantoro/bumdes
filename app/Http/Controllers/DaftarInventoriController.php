<?php

namespace App\Http\Controllers;

use App\Models\DaftarInventori;
use App\Models\DaftarProduk;
use App\Models\PembelianPembayaranBody;
use App\Models\PembelianPenerimaan;
use App\Models\PembelianPenerimaanBody;
use App\Models\PemesananPenjualan;
use App\Models\PemesananPenjualanBody;
use App\Models\Pengiriman;
use App\Models\PengirimanBody;
use App\Models\Penjualan;
use App\Models\PenomoranAuto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DaftarInventoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $inventory = DaftarProduk::leftJoin('pengiriman_bodies','daftar_produks.id','=','pengiriman_bodies.id_produk')
             ->leftJoin('pembelian_penerimaan_body','daftar_produks.id','=','pembelian_penerimaan_body.produk_id')
             ->selectRaw('sum(pengiriman_bodies.qty) as jual,sum(pembelian_penerimaan_body.kuantitas) as beli,nama_produk,harga_beli,harga_anggota,stok,daftar_produks.id,kode_produk')
            ->where('inventory','=','1')
             ->groupBy('daftar_produks.id')
             ->paginate(10);

        return view("inventori.daftar_inventory.index",compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $headpembelian = PenomoranAuto::Pembelian()->first();
        $headpemnjualan = PenomoranAuto::Penjualan()->first();
        $daftar_inventory = DB::table('pengiriman_bodies')
            ->leftJoin('pengirimans','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
            ->leftJoin('daftar_produks','daftar_produks.id','=','pengiriman_bodies.id_produk')
            ->selectRaw("id_produk,no_pengiriman,nama_produk,qty,stok,pengirimans.created_at,stok_berkurang,pengirimans.id,pengirimans.non_anggota,(qty*harga_anggota) as total_harga");
        $daftar_inventory_pemebelian = DB::table('pembelian_pembayaran_body')
            ->join('pembelian_pembayaran','pembelian_pembayaran_body.id_pembelian_pembayaran','=','pembelian_pembayaran.id')
            ->join('daftar_produks','daftar_produks.id','=','pembelian_pembayaran_body.produk')
            ->selectRaw("produk,invoice,nama_produk,pembelian_pembayaran_body.qty,pembelian_pembayaran_body.stok,pembelian_pembayaran.created_at,stok_bertambah,pembelian_pembayaran.id,supplier,(pembelian_pembayaran_body.qty*harga_beli) as total_harga")
            ->union($daftar_inventory)->orderBy('created_at','desc')->paginate(10);

        return view("inventori.daftar_inventory.create",compact('daftar_inventory_pemebelian','headpemnjualan','headpembelian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DaftarInventori::create($request->all());

        return redirect()
            ->route("daftar_inventori.index")
            ->with("success", __("Pengajuan Daftar Inventori Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

        $headpembelian = PenomoranAuto::Pembelian()->first();
        $headpemnjualan = PenomoranAuto::Penjualan()->first();
        $produk = DaftarProduk::with('kategoris','satuan','pajakbeli','pajakjual')->find($id);
//        image produk storage
        $gambar = Storage::disk('public')->files('produk/'.$id);

        $penjualan = PengirimanBody::where('id_produk','=',$id)->selectRaw('sum(total_amount_all) as total')->first();
        $penjualan_body = PengirimanBody::where('id_produk','=',$id)->selectRaw('sum(qty) as qty')->first();
        $pembelian = PembelianPembayaranBody::selectRaw('sum(pembelian_pembayaran_body.qty) as qty_stok,(sum(pembelian_pembayaran_body.qty) * daftar_produks.harga_beli) as total_stok')
            ->leftJoin('daftar_produks','daftar_produks.id','=','pembelian_pembayaran_body.produk')->where('produk',$id)->first();
        $daftar_inventory = DB::table('pengiriman_bodies')
            ->leftJoin('pengirimans','pengirimans.id','=','pengiriman_bodies.id_pengiriman')
            ->leftJoin('daftar_produks','daftar_produks.id','=','pengiriman_bodies.id_produk')
            ->where('id_produk',$id)->selectRaw("id_produk,no_pengiriman,nama_produk,qty,stok,pengirimans.created_at,stok_berkurang,pengirimans.id,pengirimans.non_anggota");
        $daftar_inventory_pemebelian = DB::table('pembelian_pembayaran_body')
            ->join('pembelian_pembayaran','pembelian_pembayaran_body.id_pembelian_pembayaran','=','pembelian_pembayaran.id')
            ->join('daftar_produks','daftar_produks.id','=','pembelian_pembayaran_body.produk')
            ->where('produk',$id)->selectRaw("produk,invoice,nama_produk,pembelian_pembayaran_body.qty,pembelian_pembayaran_body.stok,pembelian_pembayaran.created_at,stok_bertambah,pembelian_pembayaran.id,supplier")
            ->union($daftar_inventory)->orderBy('created_at','desc')->paginate(10);

        return view("inventori.daftar_inventory.pergerakan_inventory.show", \compact('headpembelian','headpemnjualan',"daftar_inventory_pemebelian",'produk','penjualan','penjualan_body','pembelian','gambar'));
    }

    public function show2(DaftarInventori $daftar_inventori)
    {
        //
        return view("daftar_inventori.show2", \compact("daftar_inventori"));
    }

    public function lihat(DaftarInventori $daftar_inventori)
    {
        //
        return view("daftar_inventori.lihat", \compact("daftar_inventori"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarInventori $daftar_inventori)
    {
        return view("daftar_inventori.edit", \compact("daftar_inventori"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaftarInventori $daftar_inventori)
    {
        $daftar_inventori->fill($request->all());

        $daftar_inventori->save();

        return redirect()
            ->route("daftar_inventori.index")
            ->with("success", __("Perbaharui Daftar Inventori Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarInventori $daftar_inventori)
    {
        //
    }
}
