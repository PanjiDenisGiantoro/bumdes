<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RekeningSimjaka;
use App\Models\produkRekeningSimpanan;

class LaporanSimpananBerjangka extends Controller
{
    public function produkIndex(Request $request) {

        if (empty($request->query('datefilter'))) {
            $request->merge([
                'datefilter' => implode(' - ', [
                    Carbon::now()->startOfMonth()->format('d/m/Y'),
                    Carbon::now()->endOfMonth()->format('d/m/Y'),
                ]),
            ]);
        }

        $dates = array_unique(explode(' - ', $request->query('datefilter')));

        $berjangka = false;
        $anggotaBerjangka = false;
        $produkId = false;
        $senaraiBerjangka = false;
        $nominatifBerjangka = false;

        $senaraiBerjangka = produkRekeningSimpanan::get();

        if (!empty($request->produkId)) {

            if ($request->produkId == '999') {

                $nominatifBerjangka = produkRekeningSimpanan::with('rekenings')
                    ->get();

            } else {

                $berjangka = produkRekeningSimpanan::first();

                $anggotaBerjangka = RekeningSimjaka::filter($request->all())
                    ->with([
                        'anggota', 
                        // 'entries' => function ($query) use ($dates) {
                        //     $query->whereHas('ledger', function ($query) use ($dates) {
                        //         $query->whereBetween('tanggal_transaksi', [
                        //             \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d'),
                        //             \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                        //         ]);
                        //     });
                        // },
                        // 'lastEntry' => function ($query) use ($dates) {
                        //     $query->whereHas('ledger', function ($query) use ($dates) {
                        //         $query->where('tanggal_transaksi', '<=', \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'));
                        //     });
                        // },
                    ])
                    ->get();

                $anggotaBerjangka->each(function ($simpanan) {
                    if (!empty($simpanan->lastEntry->current_balance)) {
                        $simpanan->saldo = $simpanan->lastEntry->current_balance;
                    }

                    $simpanan->saldo_rata_rata = $simpanan->entries->pluck('current_balance')->avg();

                    if (empty($simpanan->saldo_rata_rata)) {
                        $simpanan->saldo_rata_rata = (\Cknow\Money\Money::parse(config('money.defaultCurrency') . $simpanan->saldo))->formatByDecimal();
                    }
                });

                $produkId = $request->produkId;
            }
        }

        // if (request()->query('export') == 'pdf') {
        //     $pdf = PDF::loadView('tenants.admin.laporan_simpanan_berjangka.produk.show_pdf', 
        //     [
        //         'dataProduk' => $berjangka,
        //         'dataAnggota' => $anggotaBerjangka
        //     ], [], [
        //         'title' => 'laporan',
        //     ]);
            
        //     return $pdf->stream('laporan.pdf');
        // }

        // if (request()->query('export') == 'pdfnominatif') {
                
        //     $pdf = PDF::loadView('tenants.admin.laporan_simpanan_berjangka.produk.show_pdf_nominatif', [
        //         'data' => $nominatifBerjangka,
        //     ], [], [
        //         'title' => 'laporan Nominatif',
        //         'orientation' => 'L',
        //     ]);
        //     return $pdf->stream('Laporan Simpanan Anggota.pdf');
        // }

        // if (request()->query('export') == 'xlsx') {
        //     return \Excel::download(new LaporanProdukSimpananBerjangkaExport($berjangka, $anggotaBerjangka), 'Laporan Simpanan Berjangka Anggota.xlsx');
        // }

        return view('semua_laporan.laporan_rekening_simjaka.produk.index', compact('senaraiBerjangka', 'berjangka', 'anggotaBerjangka', 'produkId', 'nominatifBerjangka'));
    }

    public function rekeningIndex(Request $request) {
        if (empty($request->query('datefilter'))) {
            $request->merge([
                'datefilter' => implode(' - ', [
                    now()->startOfMonth()->format('d/m/Y'),
                    now()->endOfMonth()->format('d/m/Y'),
                ]),
            ]);
        }
        $dates = array_unique(explode(' - ', $request->query('datefilter')));
        
        $akunBerjangka = false;
        $simpananId = false;
        $simpananBerjangka = false;  

        $simpananBerjangka = RekeningSimjaka::with('anggota')
            ->with('produk')
            ->get();
            

        if (!empty($request->simpananId)) {

            $akunBerjangka = RekeningSimjaka::filter($request->all())
                ->with('anggota')
                ->with('produk')
                ->with('entries')
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

            // $historySimpanan = \App\Models\LedgerEntry::where('ledgerable_id', '=', $request->simpananId)
            //     ->where('ledgerable_type', '=', 'App\Model\Simpanan')
            //     ->get();

            $simpananId = $request->simpananId;
        }

        return view('semua_laporan.laporan_rekening_simjaka.rekening.index', compact('simpananBerjangka', 'akunBerjangka', 'simpananId'));
    }

    public function bagihasil(Request $request)
    {
        $berjangka = true;

        $distribusiBagiHasil = collect();

        $produk = produkRekeningSimpanan::get();

        // if (!empty($request->query('month'))) {
        //     $distribusiBagiHasil = DistribusiBagiHasil::join('bagi_hasil', 'bagi_hasil_id', '=', 'bagi_hasil.id')
        //         ->selectRaw('distribusi_bagi_hasil.id as d_id, rekening_id, saldo_rata_rata, nominal_bagi_hasil')
        //         ->with(['rekening' => function ($query) {
        //             $query
        //                 // ->select('id', 'anggota_id')
        //                 ->with('anggota:id,nama_penuh');
        //         }])
        //         ->where('jenis', '=', 1)
        //         ->where('bulan', '=', $request->query('month'))
        //         ->where('tahun', '=', date('Y'))
        //         ->get();
        // }
        return view('semua_laporan.laporan_rekening_simjaka.bagi_hasil.index', compact('distribusiBagiHasil', 'berjangka'));
    }
}
