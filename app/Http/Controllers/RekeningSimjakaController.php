<?php

namespace App\Http\Controllers;

use App\Models\Akad;
use App\Models\Anggota;
use App\Models\KodePerusahaan;
use App\Models\RekeningSimjaka;
use Illuminate\Http\Request;
use App\Models\RekeningSimpanan;
use App\Models\SumberDana;
use App\Models\TujuanPengajuan;
use App\Models\PenomoranAuto;
use App\ModelFilters\RekeningSimjakaFilter;
class RekeningSimjakaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $berjangka = RekeningSimjaka::filter($request->all())->with('anggota', 'produk')->orderBy('id', 'desc')->get();

        return view('rekening-simjaka.index', compact('berjangka'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarAnggota = Anggota::where('status_aktif','1')->get();

        $akadList = Akad::where('tipe_akad','=','simpanan_berjangka')->get();
        $tujuanList = TujuanPengajuan::all();
        $sumberDana = SumberDana::all();

        return view('rekening-simjaka.form', compact('daftarAnggota', 'akadList', 'tujuanList', 'sumberDana'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->merge([
            'status' => \App\Models\RekeningSimpanan::STATUS_PENDING
        ]);
        RekeningSimjaka::create($request->except('_token'));

        return \redirect()
            ->route("rekening.simjaka.index")
            ->with("message",("Rekening simjaka berhasil terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RekeningSimpanan  $rekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rekening = RekeningSimjaka::where('id', '=', $id)->first();

        return view('rekening-simjaka.show', compact('rekening'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RekeningSimpanan  $rekeningSimpanan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rekening = RekeningSimjaka::where('id', '=', $id)
            ->with('rekening_basil.produk')
            ->first();

//        ddd($rekening);
        $daftarAnggota = Anggota::all();
        $akadList = Akad::where('tipe_akad','=','simpanan_berjangka')->get();
        $tujuanList = TujuanPengajuan::all();
        $sumberDana = SumberDana::all();

        return view('rekening-simjaka.form', compact('rekening', 'daftarAnggota', 'akadList', 'tujuanList', 'sumberDana'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rekening = RekeningSimjaka::find($id);

        if ($request->status == 'disetujui') {
            // $auto = PenomoranAuto::where('keterangan','=', 'simpanan_berjangka')->first();

            $count = RekeningSimjaka::where('status', '!=', 'baru')
                ->where('status', '!=', 'ditolak')
                ->count() + 1;

                $kodeperusahaan = PenomoranAuto::where('keterangan', '=', 'simpanan_berjangka')->first();

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
            $kode = KodePerusahaan::first();
            $no = $kode->kode_perusahaan . $kode->kode_cabang . $rekening->produk->kode_simpanan . str_pad($count, 5, 0, STR_PAD_LEFT);
            // $no = $kodeperusahaan->kode_perusahaan . $kodeperusahaan->kode_cabang . $rekening->produk->kode_simpanan . str_pad($count, 5, 0, STR_PAD_LEFT);

            $request->merge([
                'no_akun' => $no,
                'moderated_at' => date('Y-m-d H:i:s'),
            ]);
            $rekening->update($request->except([
                '_method',
                '_token',
                'jangka_waktu',
            ]));
            $rekening->save();


            return \redirect()
                ->route("rekening.simjaka.index")
                ->with("message",("Rekening simpanan berjangka berhasil disetujui"));
        } elseif($request->status == 'ditolak') {
            // $auto = PenomoranAuto::where('keterangan','=', 'simpanan_berjangka')->first();

            $count = RekeningSimjaka::where('status', '!=', 'baru')
                    ->where('status', '!=', 'ditolak')
                    ->count() + 1;

            $kodeperusahaan = PenomoranAuto::where('keterangan', '=', 'simpanan_berjangka')->first();


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
            $no = $kodeperusahaan->kode_perusahaan . $kodeperusahaan->kode_cabang . $rekening->produk->kode_simpanan . str_pad($count, 5, 0, STR_PAD_LEFT);

            $request->merge([
                'no_akun' => $no,
                'moderated_at' => date('Y-m-d H:i:s'),
            ]);
            $rekening->update($request->except([
                '_method',
                '_token',
                'jangka_waktu',
            ]));
            $rekening->save();


            return \redirect()
                ->route("rekening.simjaka.index")
                ->with("message",("Rekening simpanan berjangka ditolak"));
        }else{
            // $auto = PenomoranAuto::where('keterangan','=', 'simpanan_berjangka')->first();

            $count = RekeningSimjaka::where('status', '!=', 'baru')
                    ->where('status', '!=', 'ditolak')
                    ->count() + 1;

            $kodeperusahaan = PenomoranAuto::where('keterangan', '=', 'simpanan_berjangka')->first();


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
            // $no = $kodeperusahaan->kode_perusahaan . $kodeperusahaan->kode_cabang . $rekening->produk->kode_simpanan . str_pad($count, 5, 0, STR_PAD_LEFT);

            $request->merge([
                // 'no_akun' => $no,
                'moderated_at' => date('Y-m-d H:i:s'),
            ]);
            $rekening->update($request->except([
                '_method',
                '_token',
                'jangka_waktu',
            ]));
            $rekening->save();


            return \redirect()
                ->route("rekening.simjaka.index")
                ->with("message",("Rekening simpanan berjangka berhasil terupdate"));
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

}
