<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DaftarPembiayaan;
use App\Models\DaftarWarung;
use App\Models\RekeningPendanaan;
use App\Models\RekeningSimpanan;
use App\Models\SettingBatch;
use App\Models\SumberPendanaan;
use App\Models\SummaryBatch;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Image;

class DaftarPembiayaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $batch = SettingBatch::with('sumber_pendanaans')->where('summary_batch',$request->regKtp)->first();
            return response()->json(['results' => $batch]);
        }

        $daftar = DaftarPembiayaan::with('anggota','sumber_pendanaan')->orderBy('created_at', 'DESC')->paginate(10);
        return view("daftar_pembiayaan.index", compact('daftar'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = Anggota::where('status_aktif','=','1')->pluck('nama_pemohon', 'id');
        $batchs = SummaryBatch::where('status', 0)->get();
        return view("daftar_pembiayaan.form", compact('anggota','batchs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            // 'batch' => 'required',
            'tanggal_permohonan' => 'required',
            // 'plafon' => 'required',
            'lama_usaha' => 'required',
            'usaha' => 'required',
            'lingkungan' => 'required',
            'omset_harian' => 'required',
            'pengeluaran' => 'required',
            'pengelola' => 'required',
        ]);

        $request->merge([
            'status' => \App\Models\DaftarPembiayaan::STATUS_PENDING
        ]);

        $validat = DaftarPembiayaan::where('id_anggota',$request->id_anggota)->nonactive()->count();
        if ($validat >0)
        {
            return redirect()
                ->route("daftar_pembiayaan.index")
                ->with("info", ("Data Pembiayaan Anda Masih Aktif"));
        }
//        DB::beginTransaction();
//        try {
//         RekeningPendanaan::create([
//                 'status' => 'baru',
// //                'rekening_type' => 'App\Models\RekeningPendanaan',
//                 'anggota_id' => $request->id_anggota,
// //                'no_akun' => 'R' . $daftarpendanaanCount,
//                 'created_at' => date('Y-m-d H:i:s')
//             ]);
            DaftarPembiayaan::create($request->all());
//            DB::commit();

            return redirect()
                ->route("daftar_pembiayaan.index")
                ->with("message", ("Daftar Pembiayaan Berhasil"));
//        }catch (\Exception $ex) {
//            Log::debug($ex);
//            DB::rollback();
//            return redirect()
//                ->route('daftar_pembiayaan.index')
//                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $anggota = Anggota::pluck('nama_pemohon', 'id');
        $daftar_pembiayaan = DaftarPembiayaan::with('anggota')->where('id', $id)->first();
        $id_anggota = Anggota::with('kodependidikan', 'statuskeluarga', 'province', 'regencies', 'districts', 'villages')->where('id', $daftar_pembiayaan->id_anggota)->first();
        $warung = DaftarWarung::with('anggota', 'statusbangunan', 'province', 'regencies', 'districts', 'villages','bidangusaha')->where('id_anggota', $daftar_pembiayaan->id_anggota)->first();
        $file_ktp = Storage::disk('public')->files('ktp/' . $daftar_pembiayaan->id_anggota);
        $file_foto = Storage::disk('public')->files('selfi/' . $daftar_pembiayaan->id_anggota);
        $sumber_pendanaan = SumberPendanaan::all();

        $file_warung = Storage::disk('public')->files('warung/' . $warung->id);
        $file_warung1 = Storage::disk('public')->files('warung1/' . $warung->id);
        $file_warung2 = Storage::disk('public')->files('warung2/' . $warung->id);
        $file_warung3 = Storage::disk('public')->files('warung3/' . $warung->id);
        $bukti = Storage::disk('public')->files('bukti/' . $daftar_pembiayaan->id);
        $buktianalisa = Storage::disk('public')->files('buktianalisa/' . $daftar_pembiayaan->id);
        return view("daftar_pembiayaan.show", \compact("daftar_pembiayaan",'bukti','buktianalisa','anggota', 'file_foto', 'file_ktp', 'file_warung', 'file_warung1', 'file_warung2', 'file_warung3', 'id_anggota', 'warung','sumber_pendanaan'));

    }
    public function lihat(Request $request, $id)
    {
        $anggota = Anggota::pluck('nama_pemohon', 'id');
//        $transaksiList = DaftarPembiayaan::with('rekenings.ledgers','ledgers.ledger','anggota')->where('id_anggota',$id)->paginate(10);
//        $transaksiList = DaftarPembiayaan::with('rekenings')->where('id_anggota',$id)->paginate(10);
//
//        ddd($transaksiList);
        $daftar_pembiayaan = DaftarPembiayaan::with('anggota')->where('id', $id)->first();
        $id_anggota = Anggota::with('kodependidikan', 'statuskeluarga', 'province', 'regencies', 'districts', 'villages')->where('id', $daftar_pembiayaan->id_anggota)->first();
        $warung = DaftarWarung::with('anggota', 'statusbangunan', 'province', 'regencies', 'districts', 'villages','bidangusaha')->where('id_anggota', $daftar_pembiayaan->id_anggota)->first();
        $sumber_pendanaan = SumberPendanaan::all();
        $file_ktp = Storage::disk('public')->files('ktp/' . $daftar_pembiayaan->id_anggota);
        $file_foto = Storage::disk('public')->files('selfi/' . $daftar_pembiayaan->id_anggota);

        $file_warung = Storage::disk('public')->files('warung/' . $warung->id);
        $file_warung1 = Storage::disk('public')->files('warung1/' . $warung->id);
        $file_warung2 = Storage::disk('public')->files('warung2/' . $warung->id);
        $file_warung3 = Storage::disk('public')->files('warung3/' . $warung->id);
        $bukti = Storage::disk('public')->files('bukti/' . $daftar_pembiayaan->id);
        $buktianalisa = Storage::disk('public')->files('buktianalisa/' . $daftar_pembiayaan->id);
        $transaksiList = RekeningSimpanan::with('ledgers','ledgers.ledger','anggota')->where('id',$id)->paginate(10);



        $users = RekeningSimpanan::with(['ledgers','ledgers.ledger','anggota']);
        $users1 = $users->wherehas('anggota', function( $query ) use ( $daftar_pembiayaan ){
            $daftar_pembiayaan->where('id', $daftar_pembiayaan->id_anggota);
        });
        $users22 = $users1->get();

//        ddd($users22);
        return view("daftar_pembiayaan.showup", \compact('users',"daftar_pembiayaan",'bukti','buktianalisa','anggota', 'file_foto', 'file_ktp', 'file_warung', 'file_warung1', 'file_warung2', 'file_warung3', 'id_anggota', 'warung','sumber_pendanaan'));
    }

    public function cetak(Request $request, $id)
    {
        $anggota = Anggota::pluck('nama_pemohon', 'id');
        $daftar_pembiayaan = DaftarPembiayaan::with('anggota.province','anggota.villages','anggota.districts','anggota.city','sumber_pendanaan')->where('id', $id)->first();
        $logo = '';
        if (\is_file('ksn2.jpg')) {
            $logo = 'data:image/png;base64,' . base64_encode(file_get_contents('ksn2.jpg'));
        }
        $pdf = PDF::loadView('daftar_pembiayaan.cetak', ['anggota' => $anggota, 'daftar_pembiayaan' => $daftar_pembiayaan,'logo' => $logo]);
        return $pdf->stream('Pendanaan.pdf', ['Attachment' => false]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $anggota = Anggota::pluck('nama_pemohon', 'id');
        $daftar_pembiayaan = DaftarPembiayaan::with('anggota')->where('id', $id)->first();
        $id_anggota = Anggota::with('kodependidikan', 'statuskeluarga', 'province', 'regencies', 'districts', 'villages')->where('id', $daftar_pembiayaan->id_anggota)->first();

        $sumber_pendanaan = SumberPendanaan::all();
        $warung = DaftarWarung::with('anggota', 'statusbangunan', 'province', 'regencies', 'districts', 'villages','bidangusaha')->where('id_anggota', $daftar_pembiayaan->id_anggota)->first();
        $file_ktp = Storage::disk('public')->files('ktp/' . $daftar_pembiayaan->id_anggota);
        $file_foto = Storage::disk('public')->files('selfi/' . $daftar_pembiayaan->id_anggota);
        $file_warung = Storage::disk('public')->files('warung/' . $warung->id);
        $file_warung1 = Storage::disk('public')->files('warung1/' . $warung->id);
        $file_warung2 = Storage::disk('public')->files('warung2/' . $warung->id);
        $file_warung3 = Storage::disk('public')->files('warung3/' . $warung->id);
        $bukti = Storage::disk('public')->files('bukti/' . $daftar_pembiayaan->id);
        $buktianalisa = Storage::disk('public')->files('buktianalisa/' . $daftar_pembiayaan->id);
//        for ($i = 0;$i<4;$i++){
//            $warung[$i] = Storage::disk('public')->files('warung/$i'.$id);
//        }
        return view("daftar_pembiayaan.edit", \compact("daftar_pembiayaan", 'bukti','buktianalisa','anggota', 'file_foto', 'file_ktp', 'file_warung', 'file_warung1', 'file_warung2', 'file_warung3', 'id_anggota', 'warung','sumber_pendanaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $daftar_pembiayaan = DaftarPembiayaan::find($id);
        if ($request->hasil_pengajuan == 'diterima')
        {
            $request->merge(['no_rekening' => $request->no_rekening]);
        }else if ($request->hasil_pengajuan == 'tertunda')
        {
            $request->merge(['no_rekening' => '']);
        }else{
            $request->merge(['no_rekening' => '']);
        }
        $daftar_pembiayaan->fill($request->all());
        $daftar_pembiayaan->save();
        $daftarpendanaanCount = DaftarPembiayaan::count()+ 1;

        if ($daftar_pembiayaan->hasil_pengajuan == 'diterima')
        {
            RekeningPendanaan::where('anggota_id',$daftar_pembiayaan->id_anggota)
                ->update([
                'status' => 'disetujui',
//                'status_aktif' => 'tidak_aktif',
                'no_akun' => $request->no_rekening,
            ]);
        }else if ($daftar_pembiayaan->hasil_pengajuan == 'tertunda')
        {
        }else{
            RekeningSimpanan::where('anggota_id',$daftar_pembiayaan->id_anggota)
                ->update([
                    'status' => 'tidak_disetujui',
                ]);
        }


        $file = $request->file('filebukti');
        $file_serfie = $request->file('filebukti2');
        $files = \Illuminate\Support\Facades\Storage::files("bukti/$id");
        if($request->exists_file_gambar) {
            $sd =  \Illuminate\Support\Facades\Storage::delete($files);
        }
        if (!empty($file)) {
            Storage::disk('local')->makeDirectory('public/bukti/' . $daftar_pembiayaan->id, 0775, true);
            $destinationPath = storage_path('app/public/bukti/' . $daftar_pembiayaan->id);
            Storage::makeDirectory($destinationPath);
            $extension = $file->getClientOriginalExtension();
            $filesname = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(500, 300);
            $image_resize->save($destinationPath . '/' . $filesname, 80);
        }

        //delete image
        $files = \Illuminate\Support\Facades\Storage::files("buktianalisa/$id");
        if($request->exists_file_gambar1) {
            $sd =  \Illuminate\Support\Facades\Storage::delete($files);
        }
        if (!empty($file_serfie)) {
            Storage::disk('local')->makeDirectory('public/buktianalisa/' . $daftar_pembiayaan->id, 0775, true);
            $destinationPath = storage_path('app/public/buktianalisa/' . $daftar_pembiayaan->id);
            Storage::makeDirectory($destinationPath);
            $extension = $file_serfie->getClientOriginalExtension();
            $filesname = $file_serfie->getClientOriginalName();
            $image_resize = Image::make($file_serfie->getRealPath());
            $image_resize->resize(500, 300);
            $image_resize->save($destinationPath . '/' . $filesname, 80);
        }
        return redirect()
            ->route("daftar_pembiayaan.index")
            ->with("message", ("Perbaharui Daftar Pembiayaan Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarPembiayaan $daftar_pembiayaan)
    {
        //
    }

    public function getdatapembiayaan(Request $request)
    {

        $pembiayaan = DaftarWarung::with('anggota', 'statusbangunan', 'province', 'regencies', 'districts', 'villages','bidangusaha')->where('id_anggota', $request->country_id)->first();
        $anggota = Anggota::with('kodependidikan', 'statuskeluarga', 'province', 'regencies', 'districts', 'villages')->where('id', $request->country_id)->first()->toArray();


        $validat = DaftarPembiayaan::where('id_anggota',$pembiayaan->anggota->id)->nonactive()->count();
        $pendidikan = $anggota['kodependidikan']['pendidikan'];
        $keluarga = $anggota['statuskeluarga']['status_dalam_keluarga'];
        $file_ktp = Storage::disk('public')->files('ktp/' . $pembiayaan->anggota->id);
        $file_foto = Storage::disk('public')->files('selfi/' . $pembiayaan->anggota->id);
        $warung1 = Storage::disk('public')->files('warung/' . $pembiayaan->id);
        $warung2 = Storage::disk('public')->files('warung1/' . $pembiayaan->id);
        $warung3 = Storage::disk('public')->files('warung2/' . $pembiayaan->id);
        $warung4 = Storage::disk('public')->files('warung3/' . $pembiayaan->id);

        $foto = $file_foto[0] ?? '';
        $foto1 = $file_ktp[0] ?? '';

        $warung1 = $warung1[0] ?? '';
        $warung2 = $warung2[0] ?? '';
        $warung3 = $warung3[0] ?? '';
        $warung4 = $warung4[0] ?? '';

        return response()->json([
            'validate' => $validat,
            'pendidikan' => $pendidikan,
            'keluarga' => $keluarga,
            'result' => $pembiayaan,
            'anggota' => $anggota,
            'gambar' => $foto,
            'gambar1' => $foto1,
            'warung1' => $warung1,
            'warung2' => $warung2,
            'warung3' => $warung3,
            'warung4' => $warung4,
        ]);
    }

}
