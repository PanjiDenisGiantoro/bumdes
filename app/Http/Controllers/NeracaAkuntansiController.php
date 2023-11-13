<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\NeracaAkuntansi;
use Illuminate\Http\Request;

class NeracaAkuntansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
        if (empty($request->query('datefilter'))) {
            $request->merge([
                'datefilter' => implode(' - ', [
                    now()->startOfMonth()->format('d/m/Y'),
                    now()->endOfMonth()->format('d/m/Y'),
                ]),
            ]);
        }

        $dates = array_unique(explode(' - ', $request->query('datefilter')));

        foreach (['A', 'L', 'C'] as $type) {
            $temp = $type;
            $$type = AkunPerkiraan::where('jenis', $type)
                ->with([
                    'descendants' => function ($query) use ($dates) {
                        $query
                            ->withDepth()
                            ->defaultOrder()
                            ->with([
                                'entries' => function ($query) use ($dates) {
                                    $query->whereHas('ledger', function ($query) use ($dates) {
                                        $query->whereBetween('date', [
                                            \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'),
                                            \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                                        ]);
                                    });
                                },
                            ]);
                    },
                ])
                ->withDepth()
                ->defaultOrder()
                ->get();

            $$type->map(function ($type) use ($dates, $temp) {
                $type->descendants->map(function ($descendant) use ($dates, $temp) {
                    if (!$descendant->isLeaf() && $descendant->entries->count() == 0) {
                        $akuns = AkunPerkiraan::whereDescendantOf($descendant)
                            ->with([
                                'entries' => function ($query) use ($dates) {
                                    $query->whereHas('ledger', function ($query) use ($dates) {
                                        $query->whereBetween('date', [
                                            \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'),
                                            \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                                        ]);
                                    });
                                },
                            ])
                            ->get();

                        foreach ($akuns as $akun) {
                            $descendant->entries = $descendant->entries->merge($akun->entries);
                        }
                    }

                    $descendant->_debit = $descendant->entries->reduce(function ($carry, $entry) {
                        if ($entry->credit) return $carry;

                        return $carry + $entry->amount;
                    });

                    $descendant->_credit = $descendant->entries->reduce(function ($carry, $entry) {
                        if ($entry->debit) return $carry;

                        return $carry + $entry->amount;
                    });

                    if ($temp == 'I' || $temp == 'C' || $temp == 'L') {
                        $descendant->_balance = $descendant->_credit - $descendant->_debit; //Altered - Arrave
                    } else {
                        $descendant->_balance = $descendant->_debit - $descendant->_credit; //original -Arrave
                    }
                });

                $type->_debit   = $type->descendants->filter(fn($descendant) => $descendant->depth == 1)->pluck('_debit')->sum();
                $type->_credit  = $type->descendants->filter(fn($descendant) => $descendant->depth == 1)->pluck('_credit')->sum();
                $type->_balance = $type->_debit - $type->_credit;
            });
        }

        //Left
        $descA = $A[0]->descendants->count();
        //Right
        $descL = $L[0]->descendants->count();
        $descC = $C[0]->descendants->count();

        $left = $descA;
        $right = $descL + $descC;
        $counter = '';

        if ($left < $right) {
            $A[0]->descendants = $A[0]->descendants->pad($right, []);
            $counter = $right;
        }
        if ($left > $right) {
            $diff = $left - $right;
            $C[0]->descendants = $C[0]->descendants->pad($diff, []);
            $counter = $left;
        }

        $merged = $L[0]->descendants->merge($C[0]->descendants);

        return view("semua_laporan.neraca_akuntansi.index", compact('A', 'L', 'C', 'counter', 'merged'));
    }

    
// public function index(Request $request)
    // {
    //     if (empty($request->query('datefilter'))) {
    //         $request->merge([
    //             'datefilter' => implode(' - ', [
    //                 now()->startOfMonth()->format('d/m/Y'),
    //                 now()->endOfMonth()->format('d/m/Y'),
    //             ]),
    //         ]);
    //     }

    //     $dates = array_unique(explode(' - ', $request->query('datefilter')));

    //     $aktivas = AkunPerkiraan::where('jenis', 'A')
    //         ->with([
    //             'descendants' => function ($query) use ($dates) {
    //                 $query
    //                     ->withDepth()
    //                     ->defaultOrder()
    //                     ->with([
    //                         'entries' => function ($query) use ($dates) {
    //                             $query->whereHas('ledger', function ($query) use ($dates) {
    //                                 $query->whereBetween('date', [
    //                                     \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'),
    //                                     \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
    //                                 ]);
    //                             });
    //                         },
    //                     ]);
    //             },
    //         ])
    //         ->withDepth()
    //         ->defaultOrder()
    //         ->get();

    //     $passivas = AkunPerkiraan::where('jenis', 'E')
    //         ->with([
    //             'descendants' => function ($query) use ($dates) {
    //                 $query
    //                     ->withDepth()
    //                     ->defaultOrder()
    //                     ->with([
    //                         'entries' => function ($query) use ($dates) {
    //                             $query->whereHas('ledger', function ($query) use ($dates) {
    //                                 $query->whereBetween('date', [
    //                                     \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'),
    //                                     \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
    //                                 ]);
    //                             });
    //                         },
    //                     ]);
    //             },
    //         ])
    //         ->withDepth()
    //         ->defaultOrder()
    //         ->get();

    //     if ($aktivas->count() < $passivas->count()) {
    //         $aktivas = $aktivas->pad($passivas->count(), []);
    //     }

    //     if ($aktivas->count() > $passivas->count()) {
    //         $passivas = $passivas->pad($aktivas->count(), []);
    //     }

    //     $count = $passivas->count();
        
    //     dd($passivas[0]->descendants);
        
    //     return view("semua_laporan.neraca_akuntansi.index", compact('aktivas', 'passivas', 'count'));
// }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.neraca_akuntansi.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        NeracaAkuntansi::create($request->all());

        return \redirect()
            ->route("semua_laporan.neraca_akuntansi.index")
            ->with("success", __("Pengajuan Neraca Akuntansi Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(NeracaAkuntansi $neraca_akuntansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(NeracaAkuntansi $neraca_akuntansi)
    {
        return view("neraca_akuntansi.form", \compact("neraca_akuntansi"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NeracaAkuntansi $neraca_akuntansi)
    {
        $neraca_akuntansi->fill($request->all());

        $neraca_akuntansi->save();

        return redirect()
            ->route("neraca_akuntansi.index")
            ->with("success", __("Perbaharui Neraca Akuntansi Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NeracaAkuntansi $neraca_akuntansi)
    {
        //
    }
}
