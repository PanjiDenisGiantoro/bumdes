<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\LedgerEntry;
use App\Models\PembelianPembayaran;
use App\Models\Pengiriman;
use App\Models\PengirimanBody;
use App\Models\Rekening;
use App\Models\RekeningPembiayaan;
use App\Models\RekeningSimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {

//        query anggota sum
        $terlaris = PengirimanBody::select(DB::raw('sum(qty) as kuantitas,id_produk,sum(total_amount) as total,nama_produk'))
            ->leftJoin('daftar_produks', 'daftar_produks.id', '=', 'pengiriman_bodies.id_produk')
//            ->whereYear('pengiriman_bodies.created_at', date('Y'))
            ->groupBy('id_produk')
            ->orderBy('kuantitas', 'DESC')
            ->limit(5);
        $anggota_sum = Anggota::select(DB::raw("count(*) as total"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('total');
//        ddd($anggota_sum);

        $status_anggota = DB::select(DB::raw("select count(*) as total,status_keanggotaan from anggotas
                            left join status_keanggotaan on anggotas.id_status_keanggotaan = status_keanggotaan.id
                            group by id_status_keanggotaan"));

        $chartstatus ="";
        foreach ($status_anggota as $key => $value) {
        $chartstatus.="['".$value->status_keanggotaan."',".$value->total."],";
        }
        $arr['chartstatus'] = rtrim($chartstatus,',');


//        query produk sum
        $produk = DB::select(DB::raw("select
  sum(qty) as kuantitas,
  id_produk,nama_produk
from
  `pengiriman_bodies`
  left join `daftar_produks` on `daftar_produks`.`id` = `pengiriman_bodies`.`id_produk`
group by
  `id_produk`
order by
  `kuantitas` desc
limit
  5"));

        $chartproduk ="";
        foreach ($produk as $key => $value) {
            $chartproduk.="['".$value->nama_produk."',".$value->kuantitas."],";
        }
        $arrProduk['chartproduk'] = rtrim($chartproduk,',');

//        pembelian dan penjualan
        $penjualan = Pengiriman::select(DB::raw("SUM(total) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $penjualan = array_column($penjualan, 'count');

//        $penjualan = array_column($penjualan, 'count');
        $pembelian = PembelianPembayaran::select(DB::raw("SUM(jumlah_tagihan) as count"))
            ->whereYear('created_at', date('Y'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))
            ->get()->toArray();
        $pembelian = array_column($pembelian, 'count');


//        $pembelian = array_column($pembelian, 'count');

//        rekening simpanan
        $simpanan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpanan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');

        $bulan = LedgerEntry::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');
//        berjangka
        $berjangka = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningSimpananBerjangka')
            ->whereMonth('created_at', '=', date('m'))
            ->orderBy("created_at")
            ->groupBy(DB::raw("Month(created_at)"))
            ->get()->toArray();
        $berjangka = array_column($berjangka, 'jumlah');
////        pembiayaan
        $pembiayaan = LedgerEntry::select(DB::raw("sum(current_balance) as jumlah"))
            ->where('ledgerable_type', '=', 'App\Models\RekeningPembiayaan')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('jumlah');


        return view("dashboard",$arr,compact('terlaris','anggota_sum','status_anggota','chartproduk','penjualan','pembelian','bulan','simpanan','pembiayaan'))
//             ->with('simpanan',json_encode($simpanan,JSON_NUMERIC_CHECK))
             ->with('berjangka',json_encode($berjangka,JSON_NUMERIC_CHECK))
             ->with('penjualan',json_encode($penjualan,JSON_NUMERIC_CHECK))
             ->with('pembelian',json_encode($pembelian,JSON_NUMERIC_CHECK));
    }
}
