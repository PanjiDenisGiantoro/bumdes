<?php

namespace App\Http\Controllers;

use App\Models\produkRekeningSimpanan;
use App\Models\Rekening;
use App\Models\RekeningSimpanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanSimpanan extends Controller
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

        $produkSimpanan = false;
        $produkId = false;
        $senaraiSimpanan = false;
        $simpananAnggota = collect();
        $nominatifSimpanan = false;

        $senaraiSimpanan = produkRekeningSimpanan::get();

        if (!empty($request->produkId)) {

            if ($request->produkId == '999') {

                $nominatifSimpanan = produkRekeningSimpanan::with('rekenings')
                    ->get();
                // dd($nominatifSimpanan[3]->rekenings[0]->anggota);
            } else {
                $produkSimpanan = produkRekeningSimpanan::first();

                $simpananAnggota = RekeningSimpanan::filter($request->all())
                    ->with([
                        'anggota',
                        // 'entries' => function ($query) use ($dates) {
                        //     $query->whereHas('ledger', function ($query) use ($dates) {
                        //         $query->whereBetween('date', [
                        //             \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d'),
                        //             \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                        //         ]);
                        //     });
                        // },
                        // 'lastEntry' => function ($query) use ($dates) {
                        //     $query->whereHas('ledger', function ($query) use ($dates) {
                        //         $query->where('date', '<=', \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'));
                        //     });
                        // },
                        // 'lastEntry' => function ($query) use ($dates) {
                        //     $query->whereHas('ledger', function ($query) use ($dates) {
                        //         $query->whereBetween('date', [
                        //             \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d'),
                        //             \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                        //         ]);
                        //     });
                        // },
                    ])
                    ->get();


                    $simpananAnggota->each(function ($simpanan) use ($dates){
                        $simpanan->entries = $simpanan->entries->sortBy(['ledger.date', 'ledger.id']);
                        $prev = new \App\Models\LedgerEntry();

                        foreach ($simpanan->entries as $index => $entry) {
                            if ($entry->credit) {
                                $entry->current_balance = $prev->current_balance + $entry->amount;
                            } else {
                                $entry->current_balance = $prev->current_balance - $entry->amount;
                            }
                            $prev = $entry;
                        }

                        // $temp_entries = $simpanan->entries->filter(function ($entry, $id) use ($dates) {
                        //     if (!empty($entry->ledger->date)) {
                        //         return $entry->ledger->date >= \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Ymd') && $entry->ledger->date->format('Ymd') <= \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Ymd');
                        //     } else {
                        //         return $entry;
                        //     }
                        // });

                        $simpanan->entries = $simpanan->entries->reverse();
                        $simpanan->lastEntry = $simpanan->entries->first();

                        // $simpanan->saldo_rata_rata = $temp_entries->pluck('current_balance')->avg();
                        $simpanan->saldo_rata_rata = '';

                        if (empty($simpanan->saldo_rata_rata)) {
                            $simpanan->saldo_rata_rata = (\Cknow\Money\Money::parse(config('money.defaultCurrency') . $simpanan->saldo))->formatByDecimal();
                        }
                    });

                $produkId = $request->produkId;
            }
        }

        // if ($request->query('export') == 'pdf') {
        //     $pdf = PDF::loadView('tenants.admin.laporan_simpanan.produk.show_pdf', [
        //         'dataProduk' => $produkSimpanan,
        //         'dataAnggota' => $simpananAnggota
        //     ], [], [
        //         'title' => 'Laporan Simpanan Anggota',
        //     ]);

        //     return $pdf->stream('Laporan Simpanan Anggota.pdf');
        // }

        // if ($request->query('export') == 'pdfnominatif') {

        //         $nominatifSimpanan = ProdukSimpanan::ofType(PRODUKSIMPANAN::TYPE_BIASA)
        //             ->with('rekenings.anggota')
        //             ->get();

        //     $pdf = PDF::loadView('tenants.admin.laporan_simpanan.produk.show_pdf_nominatif', [
        //         'data' => $nominatifSimpanan,
        //     ], [], [
        //         'title' => 'laporan Nominatif',
        //         'orientation' => 'L',
        //     ]);

        //     return $pdf->stream('Laporan Simpanan Anggota.pdf');
        // }

        // if (request()->query('export') == 'xlsx') {
        //     return \Excel::download(new LaporanProdukSimpananExport($produkSimpanan, $simpananAnggota), 'Laporan Simpanan Anggota.xlsx');
        // }

        return view('semua_laporan.laporan_rekining_simpanan.produk.index', compact('senaraiSimpanan', 'produkSimpanan', 'produkId', 'simpananAnggota', 'nominatifSimpanan'));
    }


    public function rekening(Request $request) {
        if (empty($request->query('datefilter'))) {
            $request->merge([
                'datefilter' => implode(' - ', [
                    now()->startOfMonth()->format('d/m/Y'),
                    now()->endOfMonth()->format('d/m/Y'),
                ]),
            ]);
        }
        $dates = array_unique(explode(' - ', $request->query('datefilter')));

        $simpananAnggota = false;
        $simpananId = false;
        $senaraiSimpanan = false;

        $senaraiSimpanan = RekeningSimpanan::with('produk')
            ->with('anggota')
            // ->paginate(10);
            ->get();

        if (!empty($request->simpananId)) {
            // $simpananAnggota = Simpanan::ofType(SIMPANAN::TYPE_BIASA)
            $simpananAnggota = RekeningSimpanan::filter($request->all())
                ->with('produk')
                ->with('anggota')
                ->with('entries')
                // ->with('entries', function ($q) use ($dates) {
                //     $q->whereHas('ledger', function ($q) use ($dates) {
                //         if (count($dates) == 1) {
                //             $q->where(
                //                 'date',
                //                 '=',
                //                 \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d')
                //             );
                //         } else {
                //             $q->whereBetween(
                //                 'date',
                //                 [
                //                     \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d'),
                //                     \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                //                 ],
                //             );
                //         }
                //     });
                // })
                ->first();

            // $historySimpanan = LedgerEntry::filter($request->all())->where('ledgerable_id', '=', $request->simpananId)
            //     ->where('ledgerable_type', '=', 'App\Model\Simpanan')
            //     ->get();

            $simpananAnggota->entries = $simpananAnggota->entries->sortBy(['ledger.date', 'ledger.id']);

            $prev = new \App\Models\LedgerEntry();
            foreach ($simpananAnggota->entries as $index => $entry) {
                if ($entry->credit) {
                    $entry->current_balance = $prev->current_balance + $entry->amount;
                } else {
                    $entry->current_balance = $prev->current_balance - $entry->amount;
                }
                $prev = $entry;
            }

            if ($simpananAnggota->entries->isNotEmpty() && $simpananAnggota->entries[0]->reason == 'Saldo') {
                unset($simpananAnggota->entries[0]);
            }

            $simpananAnggota->entries = $simpananAnggota->entries->filter(function ($entry, $id) use ($dates) {
                if (!empty($entry->ledger->date)) {
                    return $entry->ledger->date->format('Ymd') >= \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Ymd') && $entry->ledger->date->format('Ymd') <= \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Ymd');
                } else {
                    return $entry;
                }
            });

            $simpananAnggota->entries = $simpananAnggota->entries->reverse()->values();

            $simpananId = $request->simpananId;
        }

        // if ($request->query('export') == 'pdf') {
        //     $pdf = PDF::loadView('tenants.admin.laporan_simpanan.data-rek-anggota.show_pdf', ['data' => $simpananAnggota,], [], ['title' => 'Laporan Rekening Anggota',]);
        //     return $pdf->stream('Laporan Rekening Anggota.pdf');
        // }

        // if (request()->query('export') == 'xlsx') {
        //     return \Excel::download(new LaporanRekeningSimpananExport($simpananAnggota), 'Laporan Rekening Anggota.xlsx');
        // }

        return view('semua_laporan.laporan_rekining_simpanan.rekening.index', compact('senaraiSimpanan', 'simpananAnggota', 'simpananId'));
    }

    public function bagihasilSimpanan(Request $request)
    {
        $berjangka = false;

        $distribusiBagiHasil = collect();

        $produk = produkRekeningSimpanan::get();

        // if (!empty($request->query('month'))) {
        //     $distribusiBagiHasil = DistribusiBagiHasil::join('bagi_hasil', 'bagi_hasil_id', '=', 'bagi_hasil.id')
        //         ->selectRaw('distribusi_bagi_hasil.id as d_id, rekening_id, saldo_rata_rata, nominal_bagi_hasil')
        //         ->with(['rekening' => function ($query) {
        //             $query
                        // ->select('id', 'anggota_id')
                //         ->with('anggota:id,nama_penuh');
                // }])
                // ->where('jenis', '=', 0)
                // ->where('bulan', '=', $request->query('month'))
                // ->where('tahun', '=', date('Y'))
                // ->when($request->query('month'), function ($query) use ($request) {
                //     return $query->where('bulan', '=', $request->query('month'));
                // })
        //         ->get();
        // }

        // if (request()->query('export') == 'xlsx') {
        //     return \Excel::download(new LaporanBagiHasilExport($distribusiBagiHasil, $berjangka), 'Laporan Distribusi Bagi Hasil.xlsx');
        // }

        return view('semua_laporan.laporan_rekining_simpanan.laporan_bagi_hasil.index', compact('distribusiBagiHasil', 'berjangka'));
    }
}
