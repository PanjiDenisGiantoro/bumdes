<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AkunOfficer;
use App\Models\Rekening;
use App\Models\RekeningPembiayaan;
use App\Models\RekeningSimjaka;
use App\Models\RekeningSimpanan;
use Illuminate\Http\Request;

class LaporanAOController extends Controller
{
    public function aoIndex(Request $request) {

        $aoData = false;
        $simpananBiasa = false;
        $simpananBerjangka = false;
        $akunPembiayaan = false;
        $aoId = false;

        // $officer = AkunOfficer::orderBy('created_at', 'asc')->get();

        $officer = AkunOfficer::where('id', '=', '4')
            ->with('simpananBiasa.anggota')
            ->with('simpananBerjangka.anggota')
            ->with('pembiayaan.anggota')
            ->get();
        dd($officer);

        if (!empty($request->id)) {
            $aoData = AkunOfficer::filter($request->all())
                ->with('simpananBiasa.anggota')
                ->with('simpananBerjangka.anggota')
                ->with('pembiayaan.anggota')
                ->first();
            $simpananBiasa = $aoData->simpananBiasa;
            $simpananBerjangka = $aoData->simpananBerjangka;
            $akunPembiayaan = $aoData->pembiayaan;
            $aoId = $request->id;
        }

        // if (request()->query('export') == 'pdf') {
        //     $pdf = PDF::loadView('tenants.admin.laporan_ao.show_pdf', ['aoData' => $aoData,'rekeningSimpanan' => $aoData], [], [
        //         'title' => 'Laporan',
        //     ]);
        //     return $pdf->stream('laporan.pdf');
        // }else if (request()->query('export') == 'xlsx'){
        //     return Excel::download(new LaporanAOExport($aoData), 'Laporan Status Anggota .xlsx');
        // }

        return view('semua_laporan.laporan_ao.daftar_rekening.index', compact('officer', 'aoData', 'aoId', 'simpananBiasa', 'simpananBerjangka', 'akunPembiayaan'));
    }

    public function laporanrekbaruIndex(Request $request) {

        $laporanrekbaruData = false;
        $simpananBiasa = false;
        $simpananBerjangka = false;
        $akunPembiayaan = false;
        $laporanrekbaruId = false;


        $officers = AkunOfficer::all();
        // dd($officers[0]->nama);

        if (!empty($request->id)) {

            $laporanrekbaruData = AkunOfficer::with('simpananBiasa.anggota')
                ->with('simpananBerjangka.anggota')
                ->with('pembiayaan.anggota')
                // ->get();
                ->first();
            // dd($laporanrekbaruData);
            // $akunSimpanan = $laporanrekbaruData->simpanan;
            $simpananBiasa = $laporanrekbaruData->simpananBiasa;
            $simpananBerjangka = $laporanrekbaruData->simpananBerjangka;
            $akunPembiayaan = $laporanrekbaruData->pembiayaan;
            $laporanrekbaruId = $request->id;

            // dd($simpananBiasa);

        }

        // if (request()->query('export') == 'pdf') {
        //     $pdf = PDF::loadView('tenants.admin.laporan_rek_baru.show_pdf', ['laporanrekbaruData' => $laporanrekbaruData,'rekeningSimpanan' => $laporanrekbaruData], [], [
        //         'title' => 'Laporan',
        //     ]);
        //     return $pdf->stream('laporan.pdf');
        // }

            
        // dump($officers);

        return view('semua_laporan.laporan_ao.pembukaan_rekening_baru.index', compact('officers', 'laporanrekbaruData', 'laporanrekbaruId', 'simpananBiasa', 'simpananBerjangka', 'akunPembiayaan'));
    }

    public function daftarRekening(Request $request) {

        $laporanrekbaruData = false;
        $simpananBiasa = false;
        $simpananBerjangka = false;
        $akunPembiayaan = false;
        $laporanrekbaruId = false;


        $officers = AkunOfficer::all();
        // dd($officers[0]->nama);

        if (!empty($request->id)) {

            $laporanrekbaruData = AkunOfficer::with('simpananBiasa.anggota')
                ->with('simpananBerjangka.anggota')
                ->with('pembiayaan.anggota')
                // ->get();
                ->first();
            // dd($laporanrekbaruData);
            // $akunSimpanan = $laporanrekbaruData->simpanan;
            $simpananBiasa = $laporanrekbaruData->simpananBiasa;
            $simpananBerjangka = $laporanrekbaruData->simpananBerjangka;
            $akunPembiayaan = $laporanrekbaruData->pembiayaan;
            $laporanrekbaruId = $request->id;

            // dd($laporanrekbaruData->simpananBerjangka);

        }

        // if (request()->query('export') == 'pdf') {
        //     $pdf = PDF::loadView('tenants.admin.laporan_rek_baru.show_pdf', ['laporanrekbaruData' => $laporanrekbaruData,'rekeningSimpanan' => $laporanrekbaruData], [], [
        //         'title' => 'Laporan',
        //     ]);
        //     return $pdf->stream('laporan.pdf');
        // }

            
        // dump($officers);

        return view('semua_laporan.laporan_ao.daftar_rekening.index', compact('officers', 'laporanrekbaruData', 'laporanrekbaruId', 'simpananBiasa', 'simpananBerjangka', 'akunPembiayaan'));
    }

    public function kolektibilitasIndex(Request $request) {
        // ini yang bener
        // $daftarAO = AkunOfficer::with('user')->get();

        $daftarAO = AkunOfficer::get();
        $tingkatKesehatan = \App\Models\Kolekbilitas::all();
        $pembiayaan = false;
        $nominatif = false;

            if (!empty($request->id)) {

                $pembiayaan = RekeningPembiayaan::where('ao_id', '=', $request->id)
                    ->with('anggota')
                    ->get();

                foreach($pembiayaan as $i => $data) {
                    $data->entries->map(function ($entry) {
                        $entry->tanggal_transaksi = !empty($entry->ledger->tanggal_transaksi) ? $entry->ledger->tanggal_transaksi->format('Ymd') : $entry->created_at->format('Ymd');
                    });
                    $data->entries = $data->entries
                        ->sortBy('id')
                        ->unique('transaction_id')
                        ->sortBy([
                            ['tanggal_transaksi', 'desc'],
                            ['id', 'desc']
                        ]);

                    $tempohBerjalan = $data->tanggal_buka->diffInMonths(\Carbon\Carbon::now()->timezone('WIB')->format('Y-m-d'));
                    $expectedOutstanding = $data->jadwal[$tempohBerjalan]['totalSisa'];
                    $currentOutstanding = $data->sisa_pokok->add($data->sisa_bagi_hasil)->formatByDecimal();

                    $data->outstanding = $currentOutstanding;
                    $data->jumlah_seharusnya = $data->harga_jual->formatByDecimal() - $expectedOutstanding;
                    $data->jumlah_realisasi = $data->harga_jual->formatByDecimal() - $currentOutstanding;
                    
                    $tunggakan = $currentOutstanding - $expectedOutstanding;
                    $data->tunggakan = $tunggakan;
                }

                $temp = [];
                foreach($tingkatKesehatan as $i => $data) {
                    $temp[$data->nama] = $pembiayaan->filter(function ($rekening) use ($data) {
                        return $rekening->status_kolektibilitas == $data->id;
                    });
                }
                $nominatif = $temp;
            }
            
        
        return view('semua_laporan.laporan_ao.kolekbilitas.index', compact('daftarAO', 'pembiayaan', 'nominatif'));
    }
}
