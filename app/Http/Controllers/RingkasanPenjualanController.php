<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Illuminate\Http\Request;
use App\Models\PengirimanBody;
use App\Models\PemesananPenjualan;
use Illuminate\Support\Facades\DB;
use App\Models\PembelianPenerimaan;
use DateTime;

class RingkasanPenjualanController extends Controller
{
    Public function index()
    {
        $pemesanan = PemesananPenjualan::where('status_pemesanan','=','0')->sum('total');
        // dd($pemesanan);
        // $pemesanancount = $pemesanan->count();
        // $total = $
        // dd($pemesanancount);
        $sisatagihan = Pengiriman::with('termins')->where('status_pembayaran_penjualan', '=', 'Belum Lunas')->sum('sisa_tagihan');
        // dd($pengirimanbelumlunas);
        $jumlahproduk = PengirimanBody::all()->sum('harga_produk');
        $belumlunasselesai = Pengiriman::with('termins')->where('status_pembayaran_penjualan', '=', 'Belum Lunas')->sum('sisa_tagihan');
        $belumbayar = Pengiriman::with('termins')->where('status_pembayaran_penjualan', '=', 'Belum Bayar')->sum('total');
        $totalseluruh =  $belumlunasselesai + $belumbayar;
        $pengirimanlunas = Pengiriman::with('termins', 'pengirimanbodies.produk')->where('status_pembayaran_penjualan', '=', 'Lunas')->get();
                // sum total where belum lunas dan lebih dari tanggal pengiriman

        $jatuhtempo = Pengiriman::where('status_pembayaran_penjualan', '=', 'Belum Lunas')
            // ->where('tanggal_pengiriman', '>=', date('Y-m-d', strtotime('tgl_jatuh_tempo')))
            ->whereRaw(' STR_TO_DATE(tgl_jatuh_tempo, "%Y-%m-%d") <= "'.now().'"')
            ->sum('sisa_tagihan');



        $total = Pengiriman::select(DB::raw('SUM(bayar) as total'))
        ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('total');

        $bulan = Pengiriman::select(DB::raw('MONTHNAME(created_at) as bulan'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('bulan');



        $penawarandisetujui = PemesananPenjualan::where('ada_penawaran','1')->sum('total');
        $cek = DB::table("pengirimans")
        ->leftJoin("pengiriman_bodies", function($join){
            $join->on("pengirimans.id", "=", "pengiriman_bodies.id_pengiriman");
        })
        ->leftJoin("daftar_produks", function($join){
            $join->on("daftar_produks.id", "=", "pengiriman_bodies.id_produk");
        })
        ->selectRaw("sum(pengiriman_bodies.qty) as jumlah, nama_produk")
        ->where("pengirimans.status_pembayaran_penjualan", "=", 'lunas')
        ->groupBy("id_produk")
        ->get();

        // $penjualanPelanggan = Pengiriman::with('pelanggans')->selectRaw('id_pelanggan, count(*) as total')->groupBy('id_pelanggan')->get();

        $hitunganggota = PemesananPenjualan::with('pelanggans')->selectRaw('pelanggan, count(*) as total')->groupBy('pelanggan')->get();

        return view('ringkasan_penjualan.index2', compact('pemesanan', 'hitunganggota','sisatagihan', 'pengirimanlunas', 'jumlahproduk',  'totalseluruh','cek','jatuhtempo','penawarandisetujui','total','bulan'));
    }
}
