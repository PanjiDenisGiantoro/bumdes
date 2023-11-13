<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\LabaRugi;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->query('datefilter'))) {
            $request->merge([
                'datefilter' => implode(' - ', [
                    now()->startOfMonth()->format('d/m/Y'),
                    now()->endOfMonth()->format('d/m/Y'),
                ]),
            ]);
        }

        $dates      = array_unique(explode(' - ', $request->query('datefilter')));

        $pendapatan = AkunPerkiraan::where('jenis', 'I')
            ->with([
                'descendants' => function ($query) use ($dates) {
                    $query
                        ->withDepth()
                        ->defaultOrder()
                        ->with([
                            'entries' => function ($query) use ($dates) {
                                $query->whereHas('ledger', function ($query) use ($dates) {
                                    $query->where('date', '<=', now()::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'));
                                });
                            },
                        ]);
                },
            ])
            ->withDepth()
            ->defaultOrder()
            ->get();

        $pendapatan->map(function ($p) use ($dates) {
            $p->descendants->map(function ($descendant) use ($dates) {
                if (!$descendant->isLeaf() && $descendant->entries->count() == 0) {
                    $akuns = AkunPerkiraan::whereDescendantOf($descendant)
                        ->with([
                            'entries' => function ($query) use ($dates) {
                                $query
                                    ->whereHas('ledger', function ($query) use ($dates) {
                                        $query->where('date', '<=', now()::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'));
                                    });
                            },
                        ])
                        ->get();

                    foreach ($akuns as $akun) {
                        $descendant->entries = $descendant->entries->merge($akun->entries);
                    }
                }

                $descendant->_month = $descendant->entries
                                        ->filter(function ($entry) use ($dates) {
                                            if (now()::parse($entry->ledger->date)->greaterThanOrEqualTo($dates[0]) && now()::parse($entry->ledger->date)->lessThanOrEqualTo($dates[1])) {
                                                return $entry;
                                            }
                                        })
                                        ->pluck('amount')
                                        ->sum();
                                        
                $descendant->_year  = $descendant->entries->last() ? $descendant->entries->last()->current_balance : 0;
            });

            $p->_month = $p->descendants->filter(fn($descendant) => $descendant->depth == 1)->pluck('_month')->sum();
            $p->_year  = $p->descendants->filter(fn($descendant) => $descendant->depth == 1)->pluck('_year')->sum();
        });

        $pendapatan->_month = $pendapatan->pluck('_month')->sum();
        $pendapatan->_year  = $pendapatan->pluck('_year')->sum();

        $biaya      = AkunPerkiraan::where('jenis', 'E')
            ->with([
                'descendants' => function ($query) use ($dates) {
                    $query
                        ->withDepth()
                        ->defaultOrder()
                        ->with([
                            'entries' => function ($query) use ($dates) {
                                $query
                                    ->whereHas('ledger', function ($query) use ($dates) {
                                        $query->where('date', '<=', now()::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'));
                                    });
                            },
                        ]);
                },
            ])
            ->withDepth()
            ->defaultOrder()
            ->get();

        $biaya->map(function ($b) use ($dates) {
            $b->descendants->map(function ($descendant) use ($dates) {
                if (!$descendant->isLeaf() && $descendant->entries->count() == 0) {
                    $akuns = AkunPerkiraan::whereDescendantOf($descendant)
                        ->with([
                            'entries' => function ($query) use ($dates) {
                                $query
                                    ->whereHas('ledger', function ($query) use ($dates) {
                                        $query->where('date', '<=', \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'));
                                    });
                            },
                        ])
                        ->get();

                    foreach ($akuns as $akun) {
                        $descendant->entries = $descendant->entries->merge($akun->entries);
                    }
                }

                $descendant->_month = $descendant->entries
                                        ->filter(function ($entry) use ($dates) {
                                            if (\Carbon\Carbon::parse($entry->ledger->date)->greaterThanOrEqualTo($dates[0]) && \Carbon\Carbon::parse($entry->ledger->date)->lessThanOrEqualTo($dates[1])) {
                                                return $entry;
                                            }
                                        })
                                        ->pluck('amount')
                                        ->sum();

                $descendant->_year  = $descendant->entries->last() ? $descendant->entries->last()->current_balance : 0;
            });

            $b->_month = $b->descendants->filter(fn($descendant) => $descendant->depth == 1)->pluck('_month')->sum();
            $b->_year  = $b->descendants->filter(fn($descendant) => $descendant->depth == 1)->pluck('_year')->sum();
        });

        $biaya->_month = $biaya->pluck('_month')->sum();
        $biaya->_year  = $biaya->pluck('_year')->sum();

        return view("semua_laporan.laba_rugi.index", compact('pendapatan', 'biaya'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.laba_rugi.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LabaRugi::create($request->all());

        return \redirect()
            ->route("semua_laporan.laba_rugi.index")
            ->with("success", __("Pengajuan Laba Rugi Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(LabaRugi $laba_rugi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(LabaRugi $laba_rugi)
    {
        return view("laba_rugi.form", \compact("laba_rugi"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LabaRugi $laba_rugi)
    {
        $laba_rugi->fill($request->all());

        $laba_rugi->save();

        return redirect()
            ->route("laba_rugi.index")
            ->with("success", __("Perbaharui Laba Rugi Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabaRugi $laba_rugi)
    {
        //
    }
}
