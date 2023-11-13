<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DaftarProduk;
use App\Models\KodePerusahaan;
use App\Models\PemesananPenjualan;
use App\Models\PemesananPenjualanBody;
use App\Models\Pengiriman;
use App\Models\Penjualan;
use App\Models\PenjualanBody;
use App\Models\PenomoranAuto;
use App\Models\PerpajakanKeuangan;
use App\Models\TerminPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemesanan = PemesananPenjualan::with('penawaran','pelanggans','pengirimans')->orderBy('created_at', 'DESC')->paginate(10);
        return view('penjualan.penawaran.index',compact('pemesanan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penjualan = Penjualan::where('status_penawaran','=','0')->orderBy('no_pesanan')->get();
        $produk = DaftarProduk::with('satuan')->orderBy('nama_produk','ASC')->get();
        $produk_get = DB::table('daftar_produks')->join('satuan_produks','satuan_produks.id','=','daftar_produks.id_satuan')
            ->select('daftar_produks.id as id','daftar_produks.nama_produk','daftar_produks.kode_produk','satuan_produks.satuan_produk','daftar_produks.harga_anggota','daftar_produks.harga_bukan_anggota')
            ->get();
//        ddd($produk_get);
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();
        $termin = TerminPenjualan::pluck('nama_termin_penjualan','id');
        $max = PemesananPenjualan::all()->count() + 1;
        $pajak = PerpajakanKeuangan::all();
        $auto = PenomoranAuto::where('keterangan','=','Pemesanan Penjualan')->first();
        $count = PemesananPenjualan::count() + 1;

        return view('penjualan.penawaran.create',compact('auto','count','produk','pajak','anggota','termin','max','penjualan','produk_get'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            if ($request->ada_penawaran == '1') {
                $anggota = Anggota::where('nama_pemohon', '=', $request->id_pelanggan12)->first();
            $request->merge([
                'id_pelanggan' => $anggota->id,
                'non_anggota' =>$request->id_pelanggan12,
                'termin_pemesanan' => $request->termin_pemesanan1,
                'subtotal' =>$request->subtotal_produk,
            ]);
            Penjualan::where('id','=',$request->no_penawaran)->update(['status_penawaran'=>'1']);
            $penjualan = PemesananPenjualan::create($request->all());
        }else{
            if ($request->pelangganpilih != '')
            {
                $anggota = Anggota::where('id', '=', $request->pelangganpilih)->first();
                $request->merge([
                    'id_pelanggan' => $request->pelangganpilih,
                    'non_anggota' => $anggota->nama_pemohon,
                    'termin_pemesanan' =>$request->id_termin,
                    'subtotal' => $request->subtotal_produk,
                ]);
                $penjualan =   PemesananPenjualan::create($request->all());
            }else{
                $request->merge([
                    'non_anggota' =>$request->id_pelanggan12,
                    'termin_pemesanan' =>$request->id_termin,
                    'subtotal' => $request->subtotal_produk,
                ]);
            $penjualan = PemesananPenjualan::create($request->all());
            }
        }
        for ($id_produk = 0; $id_produk < count($request->id_produk); $id_produk++) {
            $produklist = DaftarProduk::where('id', $request->id_produk[$id_produk])->first();
            $orderdetail = new PemesananPenjualanBody;
            $orderdetail->id_pemesanan = $penjualan->id;

            $orderdetail->id_produk = $request->id_produk[$id_produk];
            $orderdetail->qty = $request->qty[$id_produk];
            $orderdetail->diskon = $request->diskon[$id_produk];
            $orderdetail->stok_berkurang =$produklist->stok - $request->qty[$id_produk];
            $orderdetail->harga_produk = $request->harga[$id_produk];
            $orderdetail->pajak = $request->pajak[$id_produk];
            $orderdetail->total_ppn = $request->total_pajak[$id_produk];
            $orderdetail->total_pph = $request->total_pajak_pph[$id_produk];
            $orderdetail->total_amount = $request->total_amount [$id_produk];
            $orderdetail->total_amount_all = $request->total_amount_all [$id_produk];
            $orderdetail->total_diskon = $request->total_disk [$id_produk];

            $orderdetail->save();
        }
//        for ($idproduk= 0; $idproduk < count($request->id_produk); $idproduk++){
//          DaftarProduk::where('id', $request->id_produk[$idproduk])->decrement('stok', $request->qty[$idproduk]);
//        }
        return redirect()->route('pemesanan_penjualan.index')->with("success", __("Perbaharui pemesanan penjualan Berhasil"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $penjualan = Penjualan::orderBy('no_pesanan')->get();
        $produk = DaftarProduk::with('satuan')->orderBy('nama_produk','ASC')->get();
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();
        $termin = TerminPenjualan::pluck('nama_termin_penjualan','id');
        $max = PemesananPenjualan::max('id') +1;
        $tagihan = Pengiriman::where('no_pemesanan',$id)->first();
        $enjualan = PemesananPenjualan::with('pemesanans','pelanggans','termins')->find($id);
        $enjualanbody = PemesananPenjualanBody::with('produks.satuan','termins','produks.kategoris')->where('id_pemesanan',$id)->get();
        $perusahaan = KodePerusahaan::all();

        if ($request->query('export') == 'pdf') {

            $pdf = PDF::loadView('penjualan.penawaran.cetak', ['penjualanproduk' => $enjualanbody,'perusahan' =>$perusahaan,'penjualan'=>$enjualan,'tagihan' => $tagihan]);

            return $pdf->stream('Laporan Invoice .pdf');
        }
        if ($request->query('export_do') == 'pdf') {

            $pdf = PDF::loadView('penjualan.penawaran.cetak_Do', ['penjualanproduk' => $enjualanbody,'perusahan' =>$perusahaan,'penjualan'=>$enjualan]);

            return $pdf->stream('Laporan Delivery Order .pdf');
        }
        return view('penjualan.penawaran.show',compact('enjualanbody','enjualan','produk','anggota','termin','max','penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
