<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pembiayaan;
use App\Models\Kolekbilitas;
use App\Models\ProdukRekeningPembiayaan;
use Illuminate\Http\Request;
use App\Models\RekeningPembiayaan;

class LaporanPembiayaan extends Controller
{
    public function rekeningIndex(Request $request, RekeningPembiayaan $pembiayaan) {
        $anggota = false;
        $pembiayaan = false;
        $anggotaPembiayaan = false;
        $pembiayaanId = false;

        // REMOVE FILTER BY DATE - ARRAVE 11/9/21
        // if (empty($request->query('datefilter'))) {
        //     $request->merge([
        //         'datefilter' => implode(' - ', [
        //             now()->startOfMonth()->format('d/m/Y'),
        //             now()->endOfMonth()->format('d/m/Y'),
        //         ]),
        //     ]);
        // }
        // $dates = array_unique(explode(' - ', $request->query('datefilter')));

        $anggota = RekeningPembiayaan::with('anggota')
            ->with('produk')
            ->get();

        if (!empty($request->pembiayaanId)) {

            $pembiayaan = RekeningPembiayaan::filter($request->all())
                ->where('id', '=', $request->pembiayaanId)
                ->with([
                    'anggota',
                    'produk',
                    // 'entries.ledger.rekening'
                    'entries'
                ])
                // ->with('entries', function ($q) use ($dates) {
                //     $q->whereHas('ledger', function ($q) use ($dates) {
                //         if (count($dates) == 1) {
                //             $q->where(
                //                 'tanggal_transaksi',
                //                 '=',
                //                 \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d')
                //             );
                //         } else {
                //             $q->whereBetween(
                //                 'tanggal_transaksi',
                //                 [
                //                     \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d'),
                //                     \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                //                 ],
                //             );
                //         }
                //     });
                // })
                ->first();

            $pembiayaan->entries = $pembiayaan
                ->entries
                ->sortBy('id')
                ->unique('transaction_id')
                ->sortBy([
                    ['tanggal_transaksi', 'desc'],
                    ['id', 'desc']
                ]);

            $anggotaPembiayaan = RekeningPembiayaan::filter($request->all())
                ->with('anggota')
                ->with('produk')
                ->get();

            $pembiayaanId = $request->pembiayaanId;

            // $historySimpanan = \App\Models\LedgerEntry::where('ledgerable_id', '=', $request->pembiayaanId)
            //     ->where('ledgerable_type', '=', 'App\Model\Simpanan')
            //     ->get();

            // if ($request->query('export') == 'pdf') {
            //     $pdf = PDF::loadView('tenants.admin.laporan_pembiayaan.rekening.show_pdf', [
            //         'pembiayaan' => $pembiayaan,
            //         // 'dataAnggota' => $anggotaPembiayaan,
            //         // 'dataSimpanan' => $historySimpanan
            //     ], [], [
            //         'title' => 'Laporan Rekening Pembiayaan',
            //     ]);

            //     return $pdf->stream('laporan.pdf');
            // }else if ($request->query('export') == 'xlsx'){
            //     return Excel::download(new LaporanPembiayaanExport($pembiayaan), 'Laporan Pembiayaan Rekening .xlsx');

            // }
        }

        return view('semua_laporan.laporan_pembiayan.rekening.index', compact('anggota', 'pembiayaan', 'anggotaPembiayaan', 'pembiayaanId'));
    }

    public function kolektibilitasIndex(Request $request) {

        $kesehatanId = false;
        $pembiayaan = false;
        $kolektibilitas = false;
        $nominatif = false; //Semua tingkat kesehatan
        $tingkatKesehatan = Kolekbilitas::all();
        $rekPembiayaan = false;

        if (!empty($request->kesehatanId)) {
            
            if ($request->kesehatanId == '999') {
                $rekPembiayaan = Pembiayaan::whereNotNull('status_kolektibilitas')->get();
                // $pembiayaan = Pembiayaan::whereNotNull('status_kolektibilitas')->get();

                foreach($rekPembiayaan as $i => $data) {
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

                    $tempohBerjalan = $data->tanggal_buka->diffInMonths(Carbon::now()->timezone('WIB')->format('Y-m-d'));
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
                    $temp[$data->nama] = $rekPembiayaan->filter(function ($rekening) use ($data) {
                        return $rekening->status_kolektibilitas == $data->id;
                    });
                }
                $nominatif = $temp;
                $kesehatanId = $request->kesehatanId;

            } else {

                $pembiayaan = Pembiayaan::where('status_kolektibilitas', '=', $request->kesehatanId)->get();

                $kolektibilitas = $tingkatKesehatan->filter(function ($tingkat, $id) use ($request) {
                    if ($tingkat->id == $request->kesehatanId) {
                        return $tingkat;
                    }
                });
                $kolektibilitas = $kolektibilitas->first();

                foreach($pembiayaan as $i => $data) {
                    $data->entries
                        ->map(function ($entry) {
                            $entry->tanggal_transaksi = !empty($entry->ledger->tanggal_transaksi) ? $entry->ledger->tanggal_transaksi->format('Ymd') : $entry->created_at->format('Ymd');
                        });
                    $data->entries = $data->entries
                        ->sortBy('id')
                        ->unique('transaction_id')
                        ->sortBy([
                            ['tanggal_transaksi', 'desc'],
                            ['id', 'desc']
                        ]);

                    $tempohBerjalan = $data->tanggal_buka->diffInMonths(Carbon::now()->timezone('WIB')->format('Y-m-d'));
                    $expectedOutstanding = $data->jadwal[$tempohBerjalan]['totalSisa'];
                    $currentOutstanding = $data->sisa_pokok->add($data->sisa_bagi_hasil)->formatByDecimal();
                       
                    $data->jumlah_seharusnya = $data->harga_jual->formatByDecimal() - $expectedOutstanding;
                    $data->jumlah_realisasi = $data->harga_jual->formatByDecimal() - $currentOutstanding;
                    
                    $tunggakan = $currentOutstanding - $expectedOutstanding;
                    $data->tunggakan = $tunggakan;

                }
                $kesehatanId = $request->kesehatanId;
            }
        }


        // if (request()->query('export') == 'pdfnominatif') {

        //     $rekPembiayaan = Pembiayaan::whereNotNull('status_kolektibilitas')->get();
        //     foreach($rekPembiayaan as $i => $data) {
        //         $data->entries->map(function ($entry) {
        //             $entry->tanggal_transaksi = !empty($entry->ledger->tanggal_transaksi) ? $entry->ledger->tanggal_transaksi->format('Ymd') : $entry->created_at->format('Ymd');
        //         });
        //         $data->entries = $data->entries
        //             ->sortBy('id')
        //             ->unique('transaction_id')
        //             ->sortBy([
        //                 ['tanggal_transaksi', 'desc'],
        //                 ['id', 'desc']
        //             ]);

        //         $tempohBerjalan = $data->tanggal_buka->diffInMonths(Carbon::now()->timezone('WIB')->format('Y-m-d'));
        //         $expectedOutstanding = $data->jadwal[$tempohBerjalan]['totalSisa'];
        //         $currentOutstanding = $data->sisa_pokok->add($data->sisa_bagi_hasil)->formatByDecimal();

        //         $data->outstanding = $currentOutstanding;
        //         $data->jumlah_seharusnya = $data->harga_jual->formatByDecimal() - $expectedOutstanding;
        //         $data->jumlah_realisasi = $data->harga_jual->formatByDecimal() - $currentOutstanding;
                
        //         $tunggakan = $currentOutstanding - $expectedOutstanding;
        //         $data->tunggakan = $tunggakan;
        //     }

        //     $temp = [];
        //     foreach($tingkatKesehatan as $i => $data) {
        //         $temp[$data->nama] = $rekPembiayaan->filter(function ($rekening) use ($data) {
        //             return $rekening->status_kolektibilitas == $data->id;
        //         });
        //     }
        //     $nominatif = $temp;
        //     $kesehatanId = $request->kesehatanId;

        //     // dd($nominatif);

        //     $pdf = PDF::loadView('tenants.admin.laporan_pembiayaan.kolektibilitas.show_pdf_nominatif',
        //     [
        //         'data' => $nominatif,
        //     ], [], [
        //         'title' => 'laporan',
        //         'orientation' => 'L',
        //     ]);

        //     return $pdf->stream('laporan.pdf');
        // }


        return view('semua_laporan.laporan_pembiayan.kolebilitas.index', compact('kesehatanId', 'pembiayaan', 'tingkatKesehatan', 'kolektibilitas', 'nominatif'));
    }

    public function produkIndex(Request $request) {
        $pembiayaan = false;
        $anggotaPembiayaan = false;
        $produkId = false;
        $produkPembiayaan = false;
        $nominatifPembiayaan = false;
        $produkPembiayaan = ProdukRekeningPembiayaan::all();

        if (!empty($request->produkId)) {

            if ($request->produkId == '999') {

                $nominatifPembiayaan = ProdukRekeningPembiayaan::with('rekenings')
                    ->get();
            } else {

                $pembiayaan = ProdukRekeningPembiayaan::filter($request->all())
                    ->filter($request->all())
                    ->first();
                    $produkId = $request->produkId;

                $anggotaPembiayaan = RekeningPembiayaan::filter($request->all())
                    ->with('anggota')
                    ->with('produk')
                    ->with('akads')
                    ->get();
                    $produkId = $request->produkId;
                    // dd($anggotaPembiayaan);

                // Remove rekening yg sudah lunas - Arrave 14/9/21 *requested by APL
                // foreach($anggotaPembiayaan as $key => $anggota) {
                //     if (empty($anggota->balance())) {
                //         $anggotaPembiayaan->forget($key);
                //     }
                // }
                // $anggotaPembiayaan = $anggotaPembiayaan->values();
            }

        }

        // if (request()->query('export') == 'pdf') {
        //     $pdf = PDF::loadView('tenants.admin.laporan_pembiayaan.produk.show_pdf',
        //     [
        //         'data' => $pembiayaan,
        //         'anggotaPembiayaan' => $anggotaPembiayaan
        //     ], [], [
        //         'title' => 'laporan',
        //         'orientation' => 'L',
        //     ]);

        //     return $pdf->stream('laporan.pdf');

        // } else if ($request->query('export') == 'pdfnominatif') {

        //     $nominatifPembiayaan = ProdukPembiayaan::with('rekenings')
        //         ->get();

        //     // dd($nominatifPembiayaan[0]);
        //     $pdf = PDF::loadView('tenants.admin.laporan_pembiayaan.produk.show_pdf_nominatif', [
        //         'data' => $nominatifPembiayaan,
        //     ], [], [
        //         'title' => 'laporan',
        //         'orientation' => 'L',
        //     ]);
        //     return $pdf->stream('laporan.pdf');
        // }
        // if ($request->query('export') == 'xlsx') {
        //     return \Excel::download(new LaporanPembiayaanProdukExport($produkPembiayaan,$pembiayaan,$anggotaPembiayaan,$produkId,$nominatifPembiayaan), 'Laporan Pembiayaan Produk.xlsx');
        // }

        //  if ($request->query('export') == 'xlsxnominatif'){
        //     $pembiayaan1 = ProdukPembiayaan::filter($request->all())
        //         ->filter($request->all())
        //         ->first();
        //     $nominatifPembiayaan1 = ProdukPembiayaan::with('rekenings')
        //         ->get();
        //     return \Excel::download(new LaporanPembiayaanProdukNormatifExport($produkPembiayaan,$pembiayaan1,$anggotaPembiayaan,$produkId,$nominatifPembiayaan1), 'Laporan Pembiayaan Produk Nominatif.xlsx');
        // }


        return view('semua_laporan.laporan_pembiayan.produk.index', compact('produkPembiayaan', 'pembiayaan', 'anggotaPembiayaan', 'produkId', 'nominatifPembiayaan'));
    }
}
