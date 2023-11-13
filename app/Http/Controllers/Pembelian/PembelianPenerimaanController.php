<?php

namespace App\Http\Controllers\Pembelian;

use App\Models\DaftarProduk;
use App\Models\PenomoranAuto;
use Illuminate\Http\Request;
use App\Models\PembelianPesanan;
use App\Models\PerpajakanKeuangan;
use Illuminate\Support\Facades\DB;
use App\Models\PembelianPenerimaan;
use App\Http\Controllers\Controller;
use App\Models\PembelianPesananBody;
use App\Models\PembelianPenerimaanBody;

class PembelianPenerimaanController extends Controller
{
    public function index()
    {
        $penerimaan = PembelianPenerimaan::with('pesanan', 'supplier',)->orderBy('created_at', 'DESC')->paginate(10);
        return view('pembelian.penerimaan.index',[
            'penerimaan' => $penerimaan,
//             ddd($penerimaan[2])
        ]);
    }

    public function create()
    {
        $pesanan = PembelianPesanan::where('status_pemesanan',0)->get();
        // $pesananbody = PembelianPesananBody::where('pesanan_pembelian_id', $pesanan->id)->get();x
        $code = PembelianPenerimaan::max('id') +1;
        $pajak = PerpajakanKeuangan::all();
        $auto = PenomoranAuto::where('keterangan','=','Pemesanan Pembelian')->first();
        $count = PembelianPenerimaan::count() + 1;
        $produk_get = DB::table('daftar_produks')->join('satuan_produks','satuan_produks.id','=','daftar_produks.id_satuan')
        ->select('daftar_produks.id as id','daftar_produks.nama_produk','daftar_produks.kode_produk','satuan_produks.satuan_produk','daftar_produks.harga_beli','daftar_produks.harga_bukan_anggota')
        ->get();
        return view('pembelian.penerimaan.create' ,[
            'pesanan' => $pesanan,
            'code' => $code,
            'auto' => $auto,
            'count' => $count,
            'pajak' => $pajak,
            'produk_get' => $produk_get,

        ]);
    }

    public function store(Request $request)
    {
        $penjualan = PembelianPenerimaan::create($request->only(['pesananpembelian_id','tanggal_penerimaan','no_invoice',
        'status','no_surat_jalan','jumlah_tagihan', 'pesanan_pembelianbody_id','supplier', 'termin_pembayaran']));
        for ($produk_id = 0; $produk_id < count($request->produk_id); $produk_id++) {
            $produklist = DaftarProduk::where('id', $request->produk_id[$produk_id])->first();
            $orderdetail = new PembelianPenerimaanBody();
            $orderdetail->pembelian_penerimaan_id = $penjualan->id;
            $orderdetail->produk_id = $request->produk_id[$produk_id];
            $orderdetail->kuantitas = $request->kuantitas[$produk_id];
            $orderdetail->pajak = $request->pajak[$produk_id] ?: 0;
            $orderdetail->harga_produk = $request->harga_produk[$produk_id] ?: 0;
            $orderdetail->diskon = $request->diskon[$produk_id] ?: 0;
            $orderdetail->stok_bertambah =$produklist->stok + $request->kuantitas[$produk_id];
            $orderdetail->total_amount = $request->total_amount[$produk_id] ?: 0;
            $orderdetail->total_ppn = $request->total_pajak[$produk_id] ?: 0;
            $orderdetail->total_pph = $request->total_pajak_pph[$produk_id] ?: 0;
            $orderdetail->total_amount = $request->total_amount[$produk_id] ?: 0;
            $orderdetail->total_amount_all = $request->total_amount_all[$produk_id] ?: 0;
            $orderdetail->diskongrand = $request->diskongrand[$produk_id] ?: 0;
            $orderdetail->total_sub = $request->total_sub[$produk_id] ?: 0;
            $orderdetail->total_disk = $request->total_disk[$produk_id] ?: 0;
            $orderdetail->subtotal = $request->subtotal_produk;
            $orderdetail->diskon_per_item = $request->diskon_per_item;
            $orderdetail->diskon_seluruh = $request->diskontotal;
            $orderdetail->diskon_seluruhpersen = $request->diskon_seluruhpersen ?: 0;
            $orderdetail->diskon_calculate = $request->diskon_calculate ?: 0;
            $orderdetail->biaya_pengiriman = $request->biaya_pengiriman;
            // $orderdetail->total_seluruh = $request->total_seluruh;
            $orderdetail->ppn = $request->ppn;
            $orderdetail->pph = $request->pph;
            $orderdetail->total_tertagih = $request->jumlah_tagihan;
            $orderdetail->total = $request->jumlah_tagihan ?: 0;
            $orderdetail->type_diskon = $request->type_diskon ?: 1;
            $orderdetail->save();
                 }

                 PembelianPesanan::where('id',$request->pesananpembelian_id)->update(['status_pemesanan'=>1]);
                 return redirect()->route('pembelian.penerimaan.index')->with("message", __("Tambah Penerimaan berhasil"));
    }

    public function getdatapesanan(Request $request)
    {
        $pesanan = PembelianPesanan::with('supplier', 'termin', 'ekpedisi',)->where('id', $request->country_id)->orderBy('no_pesanan', 'asc')->first();
        return response()->json($pesanan);
    }

    public function getdatapesananbody(Request $request)
    {
        $pesanan = PembelianPesananBody::with('produk', 'produk.satuan', 'pesanan.termin', 'pesanan.ekpedisi', 'pesanan.supplier' )->where('pesanan_pembelian_id', $request->country_id)->get();
        return response()->json($pesanan);
    }


    public function show($id)
    {
        $produk = DaftarProduk::with('satuan')->get();
        // ddd($produk);
        $penerimaan = PembelianPenerimaan::find($id);
        $penerimaanbody = PembelianPenerimaanBody::where('pembelian_penerimaan_id', $penerimaan->id)->get();
        // ddd($pesananbody);
        return view('pembelian.penerimaan.show', [
            'penerimaan' => $penerimaan,
            'penerimaanbody' => $penerimaanbody,
            'produk' => $produk
        ]);
    }

    // public function destroy($id)
    // {
    //     $penerimaan = PembelianPenerimaan::find($id);
    //     $penerimaan->delete();

    //     return redirect()->route('pembelian.penerimaan.index')->with("success", __("Hapus Penerimaan berhasil"));
    // }
}
