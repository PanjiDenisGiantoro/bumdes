<?php

namespace App\Http\Controllers;

use App\Exports\SummaryBatchExport;
use App\Models\Akad;
use Cknow\Money\Money;
use App\Models\Anggota;
use App\Models\SettingBatch;
use App\Models\SummaryBatch;
use Illuminate\Http\Request;
use App\Models\AkunPerkiraan;
use App\Models\KodePerusahaan;
use App\Models\DaftarPembiayaan;
use App\Models\RekeningSimpanan;
use App\Models\RekeningPendanaan;
use App\Models\RekeningPembiayaan;


use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\produkRekeningSimpanan;
use App\Models\ProdukRekeningPembiayaan;

class SummaryBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(request()->ajax()) {
            $akuns = SummaryBatch::where('sumber_pendanaan', '=', $request->id)->get();
            return response()->json(['results' => $akuns->count()]);
        }

        $batches = SummaryBatch::with('pendana', 'pengajuan_pendanaan')->get();
        // dd($batches[0]->pengajuan_pendanaan);
        return view("summary_batch.index", compact('batches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarPendana = SettingBatch::all();
        $produkSimpanan = ProdukRekeningSimpanan::simpananBiasa()->get();
        $produkPembiayaan = ProdukRekeningPembiayaan::all();
        $coaList = AkunPerkiraan::all();

        return view("summary_batch.form", compact('daftarPendana', 'produkSimpanan', 'produkPembiayaan', 'coaList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->merge([
            'status' => '0'
        ]);

        SummaryBatch::create($request->all());

        return redirect()
            ->route("summary_batch.index")
            ->with("message",("Summary Batch Berhasil Terdaftar"));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $batch = SummaryBatch::where('id', $id)
            ->with('pendana', 'produk_simpanan', 'coa_pembiayaan', 'pengajuan_pendanaan')
            ->first();

        return view("summary_batch.show", compact("batch"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $logo = '';
        if (\is_file('ksn2.jpg')) {
            $logo = 'data:image/png;base64,' . base64_encode(file_get_contents('ksn2.jpg'));
        }
        $anggota = Anggota::pluck('nama_pemohon', 'id');
        $daftar_pembiayaan = DaftarPembiayaan::with('anggota.province','anggota.villages','anggota.districts','anggota.city')->where('id', $id)->first();

        $pdf = PDF::loadView('summary_batch.cetak', ['anggota' => $anggota, 'daftar_pembiayaan' => $daftar_pembiayaan,'logo' => $logo]);
        return $pdf->stream('Pendanaan.pdf', ['Attachment' => false]);
        return view("summary_batch.cetak", \compact("daftar_pembiayaan",'logo','anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SummaryBatch $summary_batch)
    {
        $summary_batch->fill($request->all());

        $summary_batch->save();

        return redirect()
            ->route("summary_batch.index")
            ->with("success", __("Perbaharui Summary Batch Berhasil"));
    }

    public function approve(Request $request)
    {
        $batch = SummaryBatch::where('id', '=', $request->id)->first();
        $akad = Akad::where('jenis_akad', '=', 'mudharabah')->first();
        
        $tanggal_jatuh_tempo = \Carbon\Carbon::now()->addMonths($batch->jangka_waktu);
        
        $daftarPendanaan = json_decode($request->rekening);

        $perusahaan = KodePerusahaan::where('cabang_unit', '=', auth()->user()->cabang_unit)->first();
        $kodePerusahaan = $perusahaan->kode_perusahaan;
        $kodeCabang = $perusahaan->kode_cabang;

        $approveCount = 0;
        $rejectCount = 0;
        foreach($daftarPendanaan as $i => $data) {
            // dd($data);
            $pengajuanPendanaan = DaftarPembiayaan::where('id', '=', $data->id)->first();
            $count = RekeningSimpanan::count() + 1;
            $countPendanaan = RekeningPendanaan::count() + 1;

            if ($data->approve) {
                $approveCount += 1;
                $dana = RekeningPendanaan::create([
                    "anggota_id" => $pengajuanPendanaan->id_anggota,
                    // 'no_akun' => 'PD-'.'00-'.str_pad($countPendanaan, 4, 0, STR_PAD_LEFT),
                    'no_akun' => $kodePerusahaan.$kodeCabang.$batch->pendana->kode_pendana.str_pad($batch->batch, 2, 0, STR_PAD_LEFT).str_pad($countPendanaan, 4, 0, STR_PAD_LEFT),
                    'pilihan_akad' => $akad->id,
                    'produk_id' => $batch->id, // Batch id
                    'nilai_pengajuan' => $batch->nominal_dana,
                    'nilai_pembiayaan' => $batch->nominal_dana,
                    // 'interest_percentage' => '',
                    'interest' => $batch->interest,
                    // 'biaya_admin' => $batch->biaya_admin_pendana,
                    // 'biaya_materai' => '',
                    // 'biaya_registrasi' => '',
                    // 'biaya_asuransi' => '',
                    // 'biaya_transfer_luar' => '',
                    // 'tujuan_pengajuan' => '',
                    // 'keterangan_tujuan' => '',
                    'sumber_dana' => $batch->sumber_pendanaan,
                    'rek_transfer_basil' => $pengajuanPendanaan->id,
                    'jangka_waktu' => $batch->jangka_waktu,
                    'tanggal_aktif' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo->format('Y-m-d'),
                    'status' => 'aktif',
                    // 'state' => '',
                ]);
                $pengajuanPendanaan->status = \App\Models\RekeningSimpanan::STATUS_APPROVED;
                $pengajuanPendanaan->rekening_pendanaan_id = $dana->id;
                $pengajuanPendanaan->tanggal_disetujui = \Carbon\Carbon::now()->format('Y-m-d');
                $pengajuanPendanaan->save();
            } else {
                $rejectCount += 1;
                $pengajuanPendanaan->status = \App\Models\RekeningSimpanan::STATUS_REJECTED;
                $pengajuanPendanaan->tanggal_disetujui = \Carbon\Carbon::now()->format('Y-m-d');
                $pengajuanPendanaan->save();
            }
        }
        $batch->status = '1';
        $batch->tanggal_kelulusan = \Carbon\Carbon::now()->format('Y-m-d');
        $batch->tanggal_jatuh_tempo = \Carbon\Carbon::now()->addMonths($batch->jangka_waktu)->format('Y-m-d');
        $batch->approved = $approveCount;
        $batch->rejected = $rejectCount;
        $batch->save();

        
        return redirect()
            ->route("summary_batch.index")
            ->with("success", __("Perbaharui Summary Batch Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warung $warung)
    {
        //
    }
    public function status(Request $request,$id)
    {
        $cek = SettingBatch::where('summary_batch',$id)->first();
        if ($cek->status == 0)
        {
//            DaftarPembiayaan::whereIn('batch', explode(",",$id))->update(['status_batch' => 1]);
            SettingBatch::where('summary_batch',$id)->update(['status' => 1]);
        }else{
            return redirect()
                ->route("summary_batch.index")
                ->with("message",("Status Batch sudah tidak aktif"));
        }

        return redirect()
            ->route("summary_batch.index")
            ->with("message",("Status Batch sudah tidak aktif"));
    }

    public function export($id)
	{
        $sumary = DaftarPembiayaan::where('batch', '=', $id)->with('anggota','anggota.districts', 'anggota.villages', 'anggota.regencies', 'anggota.regencies')->get();
        // dd($sumary);
        // $sumary = SummaryBatch::where('id', $id)
        //     ->with('pendana', 'produk_simpanan', 'coa_pembiayaan', 'pengajuan_pendanaan',)
        //     ->first();
        // $sumaryinduk = SummaryBatch::where('id', $id)->get();

		return Excel::download(new SummaryBatchExport($sumary), 'SumarryBatch.xlsx');
	}
}
