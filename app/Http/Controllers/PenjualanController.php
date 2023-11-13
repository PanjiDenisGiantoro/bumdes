<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DaftarProduk;
use App\Models\KodePerusahaan;
use App\Models\Pengiriman;
use App\Models\Penjualan;
use App\Models\PenjualanBody;
use App\Models\PenomoranAuto;
use App\Models\PerpajakanKeuangan;
use App\Models\TerminPenjualan;
use Illuminate\Http\Request;
use PDF;
class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $penjualan = Penjualan::with('anggotas','termins')->orderBy('created_at', 'DESC')->paginate(10);
        if ($request->ajax()) {

//            $unit = Retribusi::filter($request->all())->get();
//            $unit->map(function ($a, $i) {
//                $a->text = $a->no_unit;
//            });
//
            $produk = DaftarProduk::where('id','=',$request->produk_id)->first();

            if ( $request->qty > $produk->stok){
                $cek = 'kurang';


            }else{
                $cek = 'masih';

            }
            return response()->json( ['results' => $cek]);
        }
        return view('penjualan.pesanan.index',compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = DaftarProduk::with('satuan')->orderBy('nama_produk','ASC')->get();
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();
        $termin = TerminPenjualan::pluck('nama_termin_penjualan','id');
        $pajak = PerpajakanKeuangan::all();
        $max = Penjualan::all()->count() + 1;
        $auto = PenomoranAuto::where('keterangan','=','penawaran Penjualan')->first();
        $count = Penjualan::count() + 1;
        return view('penjualan.pesanan.create',compact('auto','count','produk','anggota','termin','max','pajak'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $jumlahterminhari = TerminPenjualan::where('id','=',$request->id_termin)->first();
        $convertinthari = (int)$jumlahterminhari->hari_termin_penjualan;
        $tanggal = date('Y-m-d', strtotime($request->tanggal. ' + '.$convertinthari.' days'));

        if ($request->anggota == 1) {
            $penjualan = Penjualan::create([
                'anggota' => $request->anggota,
                'id_pelanggan' => $request->id_pelanggan,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
                'tanggal' => $request->tanggal,
                'no_pesanan' => $request->no_pesanan,
                'id_termin' => $request->id_termin,
                'diskontotal' => $request->diskontotal,
                'diskontotalrupiah' => $request->diskontotalrupiah,
                'biaya_pengiriman' => $request->biaya_pengiriman,
                'total' => $request->total,
                'status' => $request->status,
                'tipediskon' => $request->tipediskon,
                'subtotal' => $request->subtotal,
                'diskon_per_item' => $request->diskon_per_item,
                'PPN' => $request->PPN,
                'PPH' => $request->PPH,
                'diskoncalculate' => $request->diskoncalculate,
                'tamat_tempoh' =>  $tanggal
             ]);
        }else{
            $request->merge([
                'non_anggota' => $request->pelanggan1,
                'no_telepon'=>$request->no_telepon1,
                'alamat' => $request->alamat1,
                'id_pelanggan' => '',
                'tamat_tempoh' =>  $tanggal
            ]);
            $penjualan = Penjualan::create($request->all());
        }
        for ($produk_id = 0; $produk_id < count($request->produk_id); $produk_id++) {
            $orderdetail = new PenjualanBody;
            $orderdetail->id_penjualan = $penjualan->id;
            $orderdetail->produk_id = $request->produk_id[$produk_id];

            $produkCategory = DaftarProduk::where('id', $request->produk_id[$produk_id])->first();
            $orderdetail->category_id = $produkCategory->id;

            $orderdetail->qty = $request->qty[$produk_id];
            $orderdetail->harga_produk = $request->harga[$produk_id];
            $orderdetail->diskonproduk = $request->diskon[$produk_id];
            $orderdetail->pajak = $request->pajak[$produk_id];
            $orderdetail->total_ppn = $request->total_pajak [$produk_id];
            $orderdetail->total_pph = $request->total_pajak_pph [$produk_id];
            $orderdetail->total_amount = $request->total_amount [$produk_id];
            $orderdetail->total_amount_all = $request->total_amount_all [$produk_id];
            $orderdetail->total_diskon = $request->total_disk [$produk_id];
//            $orderdetail->id_terminproduk = $request->termin[$produk_id];
            $orderdetail->totalproduk = $request->total_amount[$produk_id];
            $orderdetail->save();
        }
        return redirect()->route('penjualan.index')->with("message",("Penawaran Penjualan Berhasil"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();
        $termin = TerminPenjualan::pluck('nama_termin_penjualan','id');
        $penjualan = Penjualan::with('anggotas','termins')->where('id',$id)->first();
        $penjualanproduk = PenjualanBody::with('produks.satuan','pajaks')->where('id_penjualan',$id)->get();
        $pajak = PerpajakanKeuangan::all();
        $perusahaan = KodePerusahaan::all();
        if ($request->query('export') == 'pdf') {

            $pdf = PDF::loadView('penjualan.pesanan.cetak', ['penjualanproduk' => $penjualanproduk,'perusahan' =>$perusahaan,'penjualan'=>$penjualan]);

            return $pdf->stream('Laporan Penjualan .pdf');
        }
        return view("penjualan.pesanan.show", compact('penjualan','penjualanproduk','anggota','termin','pajak'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $max = Penjualan::max('id') +1;

        $produk = DaftarProduk::with('satuan')->orderBy('nama_produk','ASC')->get();
        $anggota = Anggota::orderBy('nama_pemohon','ASC')->get();

        $termin = TerminPenjualan::pluck('nama_termin_penjualan','id');
        $penjualan = Penjualan::with('anggotas','termins')->where('id',$id)->first();
        $penjualanproduk = PenjualanBody::with('produks.satuan')->where('id_penjualan',$id)->get();
        return view("penjualan.pesanan.edit", compact('penjualan','penjualanproduk','anggota','termin','max','produk'));
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
    public function getdatapenjualan(Request $request)
    {
        $anggota = Anggota::find($request->country_id);
        return response()->json($anggota);
    }
    public function getdataproduk(Request $request)
    {
      $produk = PenjualanBody::where('id_penjualan',$request->get_param)->get();
        return response()->json($produk);
    }
    public function getdatapenawaran(Request $request)
    {
        $produk = PenjualanBody::with('produks.satuan','termins','penjualan.anggotas','penjualan.termins')->where('id_penjualan',$request->country_id)->get();
        $getproduk = DaftarProduk::all();
//        return response()->json($produk);
        return response()->json($produk);
    }
    public function tagihan()
    {
        $tagihan = Pengiriman::with('pemesanans')->Lunas()
            ->orderBy('created_at', 'DESC')->paginate(10);

        return view('penjualan.tagihan.index',compact('tagihan'));
    }
}
