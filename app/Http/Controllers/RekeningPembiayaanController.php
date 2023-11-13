<?php

namespace App\Http\Controllers;

use App\Models\Agunan;
use App\Models\Akad;
use App\Models\AkunOfficer;
use App\Models\Anggota;
use App\Models\JenisTransaksi;
use App\Models\PenomoranAuto;
use App\Models\ProdukRekeningPembiayaan;
use App\Models\produkRekeningSimpanan;
use App\Models\RekeningPembiayaan;
use App\Models\RekeningSimpanan;
use App\Models\SumberDana;
use App\Models\SumberPengembalian;
use App\Models\TujuanPengajuan;
use Illuminate\Http\Request;

class RekeningPembiayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        modelfilter

        if ($request->ajax()) {
            $rekeningPembiayaan = RekeningPembiayaan::where('id', '=', $request->id)
                ->with('produk', 'anggota')
                ->first();

            $jenis_transaksi = JenisTransaksi::where('macam_transaksi', '=', 'pembiayaan')
                ->get();

            // $produkPembiayaan->map(function ($a, $i) {
            //     $a->text = $a->nama_pembiayaan;
            // });
            return response()->json([
                'result' => $rekeningPembiayaan,
                'jenis_transaksi' => $jenis_transaksi
            ]);
        }

        $rekening = RekeningPembiayaan::filter($request->all())->with('anggota', 'produk', 'akads')->orderBy('id','DESC')->get();
        // dd($rekening);

        return view('rekening-pembiayaan.index', compact('rekening'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggotaList = Anggota::where('status_aktif','1')->get();
        $produkList = produkRekeningSimpanan::where('status','1')->get();
        $akadList = Akad::where('tipe_akad','=','pembiayaan')->get();
        $tujuan = TujuanPengajuan::all();
        $sumber_dana = SumberDana::all();
        $agunan = Agunan::all();
        $daftarAO = AkunOfficer::all();
        return view('rekening-pembiayaan.form', compact('anggotaList', 'produkList','akadList','tujuan','sumber_dana','agunan','daftarAO'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $auto = PenomoranAuto::where('keterangan','=','pembiayaan')->first();
        // $count = RekeningPembiayaan::all()->count() + 1;
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
        // $request->merge([
        //     // 'rekening_type' => 'App\Models\RekeningPembiayaan',
        //     //mas arrif history no_akun
        //     //            'no_akun' =>'1001-554-'.str_pad($count, 4, 0, STR_PAD_LEFT)
        //     'no_akun' => $text
        // ]);

        RekeningPembiayaan::create($request->except('accounts'));

        return \redirect()
            ->route("rekening-pembiayaan.index")
            ->with("message",("Pembiayaan berhasil diajukan"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rekening = RekeningPembiayaan::where('id', $id)
            ->with('produk', 'akads', 'anggota', 'ledgers','ledgers.ledger','anggota', 'rekAutodebet.produk')
            ->first();

        $rekening->ledgers = $rekening->ledgers
            ->reverse();

        return view('rekening-pembiayaan.show', compact('rekening'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $rekening = RekeningPembiayaan::where('id', '=', $id)
            ->with('anggota', 'produk', 'sumber_danas')
            ->first();
        // dd($rekening);
        $akadList = Akad::where('tipe_akad','=','pembiayaan')->get();
        $tujuan = TujuanPengajuan::all();
        $sumber_dana = SumberDana::all();


        return view('rekening-pembiayaan.form', compact('akadList', 'sumber_dana', 'rekening', 'tujuan'));
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
    public function edit_persetujuan($id)
    {
        $rekening = RekeningPembiayaan::where('id', '=', $id)
            ->with('anggota', 'produk', 'sumber_danas')
            ->first();
        // dd($rekening);

        $akadList = Akad::where('tipe_akad','=','pembiayaan')->get();
        $tujuan = TujuanPengajuan::all();
        $sumber_dana = SumberDana::all();

        return view('rekening-pembiayaan.form_persetujuan', compact('akadList', 'sumber_dana', 'rekening', 'tujuan'));
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
        $pembiayaan = RekeningPembiayaan::where('id', '=', $id)->first();

        if ($request->status == 'disetujui') {

            $auto = PenomoranAuto::where('keterangan','=','pembiayaan')->first();
            $count = RekeningPembiayaan::all()->count() + 1;
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
            $no = $auto->head.$auto->kode_perusahaan.$auto->kode_cabang.$pembiayaan->produk->kode_pembiayaan.$format_depan.$format_tengah.$format_belakang.sprintf("%05s", $count);
            $text = str_replace(' ', '', $no);

            $request->merge([
                'no_akun' => $text
            ]);
        }



        $pembiayaan->update($request->except([
            '_method',
            '_token',
            'anggota_id',
            'pilihan_akad',
            'produk_id',
        ]));

        $pembiayaan->updated_at = \Carbon\Carbon::now();
        $pembiayaan->save();

        return redirect()
            ->route('rekening-pembiayaan.index')
            ->with('success','Permohonan pembiayaan telah diubah');
    }
    public function update_persetujuan(Request $request, $id)
    {
        $pembiayaan = RekeningPembiayaan::where('id', '=', $id)->first();

        if ($request->status == 'pencairan'){
            $request->merge([
                'status' => 'pencairan',
                'tanggal_persetujuan' => date('Y-m-d'),
                'keterangan' => $request->keterangan
            ]);
            $pembiayaan->update($request->except([
                '_method',
                '_token',
                'anggota_id',
                'pilihan_akad',
                'produk_id',
            ]));
            $pembiayaan->save();
            return redirect()
                ->route('rekening-pembiayaan.index')
                ->with('message','Offerung Letter Disetujui');
        }else{
            $request->merge([
                'status' => 'ditolak',
                'tanggal_persetujuan' => date('Y-m-d'),
                'keterangan' => $request->keterangan
            ]);
            $pembiayaan->update($request->except([
                '_method',
                '_token',
                'anggota_id',
                'pilihan_akad',
                'produk_id',
            ]));
            $pembiayaan->save();
            return redirect()
                ->route('rekening-pembiayaan.index')
                ->with('message','Pembiayaan Dibatalkan');
        }

    }
    public function getDataProduk(Request $request)
    {
        if ($request->ajax()) {
         $pembiayaan = ProdukRekeningPembiayaan::where('akad_simpanan',$request->pembiayaan)->get();

            return response()->json($pembiayaan);
        }
    }
    // public function getDataAkad(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $produk = ProdukRekeningPembiayaan::where('akad_simpanan',$request->pembiayaan)->where('kategori_produk','=','pembiayaan')->get();
    //         return response()->json($produk);
    //     }
    // }
}
