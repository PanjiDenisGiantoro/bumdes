<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\JenisTransaksi;
use App\Models\KodePerusahaan;
use App\Models\Ledger;
use App\Models\Pengiriman;
use App\Models\PenomoranAuto;
use App\Models\ProdukRekeningPembiayaan;
use App\Models\produkRekeningSimpanan;
use App\Models\Rekening;
use App\Models\RekeningPembiayaan;
use App\Models\RekeningPendanaan;
use App\Models\RekeningSimjaka;
use App\Models\RekeningSimpanan;
use App\Models\SumberDana;
use App\Models\TujuanPengajuan;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekeningSimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $simpananList = RekeningSimpanan::filter($request->all())
            ->with('produk', 'anggota','akads','sumber_danas','tujuan_pengajuans','ledger','ledgerable')
            ->where('rekening_type','App\Models\RekeningSimpanan')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        if ($request->ajax()) {
            if ($request->query('anggota_id')) { //used at akun officer form -Arrave

                $rekening = RekeningSimpanan::where('anggota_id', '=', $request->anggota_id)
                    ->where('status', 'aktif')
                    ->with('produk')
                    ->get();

                return response()->json(['results' => $rekening]);

            } else {

                $simpananList->map(function ($a, $i) {
                    $a->text = $a->produk->nama_simpanan;
                });

                return response()->json(['results' => $simpananList]);
            }

        }

        return view('rekening-simpanan.index', compact('simpananList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $anggotaList = Anggota::where('status_aktif','1')->get();

        $auto = PenomoranAuto::where('keterangan','=','simpanan')->first();
        $count = RekeningSimpanan::count() + 1;
        $produkList = produkRekeningSimpanan::where('status','1')->get();
        $akadList = Akad::where('tipe_akad','=','simpanan')->get();
        $tujuanList = TujuanPengajuan::all();
        $sumber_dana = SumberDana::all();

        return view('rekening-simpanan.form', compact('auto','count','anggotaList', 'produkList','akadList','tujuanList','sumber_dana'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $auto = PenomoranAuto::where('keterangan','=','simpanan')->first();
        // $count = RekeningSimpanan::count() + 1;
        // if (!empty($auto->format_depan)) {
        //     $format_depan =date($auto->format_depan);
        // } else {
        //     $format_depan = '';
        // }
        // if (!empty($auto->format_tengah)) {
        //     $format_tengah = date($auto->format_tengah);
        // } else {
        //     $format_tengah = '';
        // }
        // if (!empty($auto->format_belakang)) {
        //     $format_belakang = date($auto->format_belakang);
        // } else {
        //     $format_belakang = '';
        // }
        // $no = $auto->head.$auto->kode_perusahaan.$auto->kode_cabang.$request->produk_id.$format_depan.$format_tengah.$format_belakang.sprintf("%05s", $count);
        // $text = str_replace(' ', '', $no);
        $request->merge([
            // 'rekening_type' => 'App\Models\RekeningSimpanan',
            // 'no_akun' => '9909090',
//            'no_akun' =>$auto->head.'/'.date($auto->format_depan).'/'.date($auto->format_tengah).'/'.date($auto->format_belakang).'/'.$count
        ]);
        RekeningSimpanan::create($request->except('accounts'));
//        penomoran auto

        return \redirect()
            ->route("rekening-simpanan.index")
            ->with("message",("Rekening simpanan berhasil terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RekeningSimpanan  $rekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auto = PenomoranAuto::where('keterangan','=','simpanan')->first();
        $count = RekeningSimpanan::count() + 1;
        $viewMode= true;
        $rekening_simpanan = Rekening::where('id',$id)->with('produk')->first();
        $akadList = Akad::all();
        $tujuanList = TujuanPengajuan::all();
        $sumber_dana = SumberDana::all();
        $anggotaList = Anggota::all();
        $produkList = produkRekeningSimpanan::all();
        return view("rekening-simpanan.form", compact('auto','count','viewMode','anggotaList', 'produkList', 'rekening_simpanan','anggotaList', 'produkList','akadList','tujuanList','sumber_dana'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RekeningSimpanan  $rekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    // public function edit(RekeningSimpanan $rekeningSimpanan)
    public function edit($id)
    {
        $anggotaList = false;
        $produkList = false;

        $auto = PenomoranAuto::where('keterangan','=','simpanan')->first();
        $count = RekeningSimpanan::count() + 1;
        $rekening_simpanan = RekeningSimpanan::with('ledgers','ledgers.ledger','anggota')->where('id',$id)->first();
        $akadList = Akad::where('tipe_akad','=','simpanan')->get();
        $tujuanList = TujuanPengajuan::all();
        $sumber_dana = SumberDana::all();
        $anggotaList = Anggota::all();
        $produkList = produkRekeningSimpanan::all();
        return view('rekening-simpanan.form', compact('auto','count','anggotaList', 'produkList', 'rekening_simpanan','anggotaList', 'produkList','akadList','tujuanList','sumber_dana'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RekeningSimpanan  $rekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Penomoran auto panji
        $auto = PenomoranAuto::where('keterangan', '=', 'simpanan')->first();
        $count = RekeningSimpanan::count() + 1;
        if (!empty($auto->format_depan)) {
            $format_depan =date($auto->format_depan);
        } else {
            $format_depan = '';
        }
        if (!empty($auto->format_tengah)) {
            $format_tengah = date($auto->format_tengah);
        } else {
            $format_tengah = '';
        }
        if (!empty($auto->format_belakang)) {
            $format_belakang = date($auto->format_belakang);
        } else {
            $format_belakang = '';
        }
        $no = $auto->head.$auto->kode_perusahaan.$auto->kode_cabang.$request->produk_id.$format_depan.$format_tengah.$format_belakang.sprintf("%05s", $count);
        $text = str_replace(' ', '', $no);

        $request->merge([
            'no_akun' => $text,
        ]);

        $rekening = RekeningSimpanan::find($id);
        $rekening->fill($request->all());
        $rekening->save();
        if($request->status == 'ditolak'){
            return \redirect()
            ->route("rekening-simpanan.index")
            ->with("message",("Pengajuan rekening simpanan ditolak"));

        }else{
            return \redirect()
            ->route("rekening-simpanan.index")
            ->with("message",("Pengajuan Rekening simpanan berhasil disetujui"));

        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RekeningSimpanan  $rekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RekeningSimpanan $rekeningSimpanan)
    {
        //
    }
    public function showTransaksi(Request $request,$id)
    {
        $simpananAkun = RekeningSimpanan::filter($request->all())->with('akunOfficer', 'produk', 'anggota','akads','sumber_danas','tujuan_pengajuans','ledger','ledgerable')->orderBy('created_at','DESC')->where('id',$id)->first();



        $transaksiList = RekeningSimpanan::with('ledgers','ledgers.ledger','anggota')->where('id',$id)->paginate(10);

        $rekening = RekeningSimpanan::where('id', '=', $id)->first();
//        ddd($transaksiList);

        return view("rekening-simpanan.show", compact('simpananAkun','transaksiList', 'rekening'));

    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $produkList = RekeningSimpanan::with('anggota','produk')->where('id','=',$request->id)
//                ->where('anggota_id','=',$request->anggota)
                ->first();
            $pendanaanList = RekeningPendanaan::with('anggota')->where('id','=',$request->id)
//                ->where('anggota_id','=',$request->anggota)
                ->first();

            $rekeningSimjaka = RekeningSimjaka::with('anggota')->where('id','=',$request->id)
                ->first();

            $rekeningPembiayaan = RekeningPembiayaan::where('id', '=', $request->id)
                ->with('produk', 'anggota')
                ->first();


            $jenis_simpanan_stor = JenisTransaksi::where('macam_transaksi','simpanan')
                ->where('kredit',0)
                ->get();

            $jenis_simpanan = JenisTransaksi::where('macam_transaksi','simpanan')
                ->get();
            $jenis_simjaka = JenisTransaksi::where('macam_transaksi','simpananberjangka')
                ->get();
            $jenis_pendanaan = JenisTransaksi::where('macam_transaksi','pendanaan')
                ->get();

            $jenis_pembiayaan_cair = JenisTransaksi::where('macam_transaksi','pembiayaan')
                ->where('kredit',0)
                ->first();

            $jenis_pembiayaan_cicil = JenisTransaksi::where('macam_transaksi','pembiayaan')
                ->where('kredit',1)
                ->first();
            return response()->json([
                'simpanan' => $produkList,
                'simjaka' => $rekeningSimjaka,
                'pendanaan' => $pendanaanList,
                'pembiayaan' => $rekeningPembiayaan ,
                'jenis_simpanan_stor' => $jenis_simpanan_stor,
                'jenis_simpanan' => $jenis_simpanan,
                'jenis_simjaka' => $jenis_simjaka,
                'jenis_pendanaan' => $jenis_pendanaan,
                'jenis_pembiayaan_cair' => $jenis_pembiayaan_cair,
                'jenis_pembiayaan_cicil' => $jenis_pembiayaan_cicil,

            ]);
        }
    }
    public function getProduk(Request $request)
    {
        if ($request->ajax()) {
            $produk = produkRekeningSimpanan::where('akad_simpanan',$request->rekening)->where('kategori_produk','=','simpanan')->get();
            return response()->json($produk);
        }
    }
}
