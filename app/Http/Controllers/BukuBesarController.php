<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\BukuBesar;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
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

        $dates = array_unique(explode(' - ', $request->query('datefilter')));

        $saldoAwal = AkunPerkiraan::filter($request->all())
            ->with([
                'entries' => function ($query) use ($dates) {
                    $query->with('ledger')->whereHas('ledger', function ($query) use ($dates) {
                        $query->whereDate('date', '<', \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'));
                    });
                },
            ])
            ->has('entries')
            ->defaultOrder()
            ->get();

        $akun = AkunPerkiraan::filter($request->all())
            ->with([
                'entries' => function ($query) use ($dates) {
                    if (count($dates) == 1) {
                        $query->with('ledger')->whereHas('ledger', function ($query) use ($dates) {
                            $query->whereDate('date', '=', \Carbon\Carbon::createFromFormat('d/m/Y', $dates[0])->format('Y-m-d'));
                        });
                    } else {
                        $query->with('ledger')->whereHas('ledger', function ($query) use ($dates) {
                            $query->whereBetween('date', [
                                \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'),
                                \Carbon\Carbon::createFromFormat('d/m/Y', $dates[1])->format('Y-m-d'),
                            ]);
                        });
                    }
                },
            ])
            ->has('entries')
            ->defaultOrder()
            ->get();

        $akun->map(function ($a) use ($saldoAwal) {
            $s = $saldoAwal
                ->filter(function ($previtem, $j) use ($a) {
                    return $previtem->id == $a->id;
                })
                ->first();


            $firstEntry = new \App\Models\LedgerEntry([
                'current_balance' => $s->entries->reduce(function ($carry, $entry) {
                    if ($entry->debit) {
                        return $carry + $entry->amount;
                    }

                    return $carry - $entry->amount;
                }),
            ]);

            $firstEntry->ledger = new \App\Models\Ledger([
                'type' => null,
                'journal_no' => null,
                'description' => 'Saldo Awal',
            ]);

            $a->entries->prepend($firstEntry);
    
            $a->entries = $a->entries->sortBy(['ledger.date', 'ledger.id']);

            $a->total_debit = $a->entries->reduce(function ($carry, $entry) {
                if ($entry->credit) return $carry;
                
                return $carry + $entry->amount;
            });

            $a->total_credit = $a->entries->reduce(function ($carry, $entry) {
                if ($entry->debit) return $carry;
                
                return $carry + $entry->amount;
            });
        });

        return view("semua_laporan.buku_besar.index", compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.buku_besar.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BukuBesar::create($request->all());

        return \redirect()
            ->route("semua_laporan.buku_besar.index")
            ->with("success", __("Pengajuan Buku Besar Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(BukuBesar $buku_besar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(BukuBesar $buku_besar)
    {
        return view("buku_besar.form", \compact("buku_besar"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BukuBesar $buku_besar)
    {
        $buku_besar->fill($request->all());

        $buku_besar->save();

        return redirect()
            ->route("buku_besar.index")
            ->with("success", __("Perbaharui Buku Besar Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BukuBesar $buku_besar)
    {
        //
    }
}
