<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use Illuminate\Http\Request;
use App\Models\PembelianPesanan;
use Illuminate\Support\Facades\DB;
use App\Models\PembelianPembayaran;
use App\Models\PembelianPenerimaan;
use App\Models\PembelianPesananBody;

class RingkasanPembelianController extends Controller
{
    // Public function index()
    // {
    //     $menunggupembayaran = PembelianPenerimaan::where('status_pembayaran', '=', 'Belum bayar')->sum('jumlah_tagihan');

    //     $sisa_tagihan = PembelianPembayaran::where('sisa_tagihan', '>', 0)->with([
    //         'penerimaan' => function ($query) {
    //             $query->where('status_pembayaran', '=', 'Belum Lunas');
    //         }
    //     ])->sum('sisa_tagihan');
    //     // dd($sisa_tagihan);

    //     $totalpesanan = PembelianPesananBody::all()->sum('total');
    //     $penjualanperproduk = PembelianPesananBody::with('produk')->groupBy('produk_id')->get();
    //     $supplierdata = PembelianPenerimaan::
    //                 where('status_pembayaran', '=', 'Belum lunas')
    //                 ->orwhere('status_pembayaran', '=', 'Lunas')
    //                 ->selectRaw('supplier,count(*) as total')->groupBy('supplier')->get();
    //     // dd($supplierdata);
    //                     // ->selectRaw('id')->groupBy('supplier')->get();
    //     // $supplierdata = PembelianPembayaran::with([
    //     //     'penerimaan' => function ($query) {
    //     //         $query->where('status_pembayaran', '=', 'Belum Lunas || Belum bayar');
    //     //     }
    //     // ])->selectRaw('supplier,count(*) as total')->groupBy('supplier')->get();
    //     // foreach ($supplierdata as $a) {
    //     //     // $a->supplier;
    //     //     dd($a->supplier);
    //     // }

    //     $jumlahqty = PembelianPesananBody::selectRaw('sum(kuantitas) as jumlah, produk_id')->groupBy('produk_id')->get();

    //     // $jatuhtempo = PembelianPenerimaan::where('status_pembayaran', '=', 'Belum Lunas || Belum bayar')
    //     //     // ->where('tanggal_pengiriman', '>=', date('Y-m-d', strtotime('tgl_jatuh_tempo')))
    //     //     ->whereRaw(' STR_TO_DATE(tgl_jatuh_tempo, "%Y-%m-%d") <= "'.now().'"')
    //     //     ->sum('sisa_tagihan');

    //     $belumbayar = PembelianPenerimaan::where('status_pembayaran', '=', 'Belum bayar')
    //                 ->whereRaw(' STR_TO_DATE(tgl_jatuh_tempo, "%Y-%m-%d") <= "'.now().'"')
    //                 ->sum('jumlah_tagihan');

    //     // dd($belumbayar);
    //     $jatuhtempo = PembelianPembayaran::with([
    //         'penerimaan' => function ($query) {
    //             $query->where('status_pembayaran', '=', 'Belum Lunas || Belum bayar')
    //             ->whereRaw('STR_TO_DATE(tgl_jatuh_tempo, "%Y-%m-%d") <= "'.now().'"');
    //         }
    //     ])->sum('sisa_tagihan');
    //     // dd($jatuhtempo);

    //     return view('ringkasan_pembelian.index', compact('menunggupembayaran', 'belumbayar', 'sisa_tagihan', 'totalpesanan',
    //     'penjualanperproduk', 'jumlahqty', 'jatuhtempo', 'supplierdata'));
    // }

    Public function home()
    {
        $menunggupembayaran = PembelianPenerimaan::where('status_pembayaran', '=', 'Belum bayar')->sum('jumlah_tagihan');

        $total = PembelianPembayaran::select(DB::raw('SUM(jumlah_bayar) as total'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('total');

//        total convert integer
        $total = $total->toArray();

        $total = array_map(function ($value) {
            return (int)$value;
        }, $total);

        $bulan = PembelianPembayaran::select(DB::raw('MONTHNAME(created_at) as bulan'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('bulan');



        $sisa_tagihan = PembelianPembayaran::where('sisa_tagihan', '>', 0)->with([
            'penerimaan' => function ($query) {
                $query->where('status_pembayaran', '=', 'Belum Lunas');
            }
        ])->sum('sisa_tagihan');
        // dd($sisa_tagihan);

        $bayarbelumselesai = PembelianPembayaran::sum('sisa_tagihan');
        $totalpesanan = PembelianPesananBody::all()->sum('total');
        $penjualanperproduk = PembelianPesananBody::with('produk')->groupBy('produk_id')->get();
        $supplierdata = PembelianPenerimaan::
                    where('status_pembayaran', '=', 'Belum lunas')
                    ->orwhere('status_pembayaran', '=', 'Lunas')
                    ->selectRaw('supplier,count(*) as total')->groupBy('supplier')->get();

        $jumlahqty = PembelianPesananBody::selectRaw('sum(kuantitas) as jumlah, produk_id')->groupBy('produk_id')->get();

        $belumbayar = PembelianPenerimaan::where('status_pembayaran', '=', 'Belum bayar')
                    ->whereRaw(' STR_TO_DATE(tgl_jatuh_tempos, "%Y-%m-%d") <= "'.now().'"')
                    ->sum('jumlah_tagihan');


        // dd($belumbayar);
        $jatuhtempo = PembelianPembayaran::with([
            'penerimaan' => function ($query) {
                $query->where('status_pembayaran', '=', 'Belum Lunas || Belum bayar')
                ->whereRaw('STR_TO_DATE(tgl_jatuh_tempos, "%Y-%m-%d") <= "'.now().'"');
            }
        ])->sum('sisa_tagihan');
        // dd($jatuhtempo);

        return view('ringkasan_pembelian.home', compact('menunggupembayaran', 'belumbayar', 'sisa_tagihan', 'totalpesanan',
        'penjualanperproduk', 'jumlahqty', 'jatuhtempo', 'supplierdata','bayarbelumselesai','total','bulan'));
    }
}
