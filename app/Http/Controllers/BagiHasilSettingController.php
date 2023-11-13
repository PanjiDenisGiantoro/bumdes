<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\KomponenBagiHasil;
use Illuminate\Http\Request;

class BagiHasilSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allGL = AkunPerkiraan::all();

        $componentList = KomponenBagiHasil::filter($request->all())->with('gl')->get();
        $currentMonth = now()->month;

        $date = [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ];

        
        if ($date[1] > now()) {
            $date[1] = now();
        }


        if ($request->query('tab', 0) == 0) {
            $componentList->map(function ($item, $i) use ($date) {
                // $simpanan = \App\Models\RekeningSimpanan::with([
                //     'entries' => function ($query) {
                //         return $query
                //             ->with('ledger')
                //             ->without('ledgerable');
                //     },
                //     'lastEntry' => function ($query) {
                //         $query->whereHas('ledger');
                //     },
                // ])

                $simpanan = \App\Models\RekeningSimpanan::whereHas('produk.akun_perkiraans', function ($query) use ($item) {
                    $query->where('id', $item->gl->id);
                })
                ->get();

               


                $simpanan->map(function ($s) use ($date) {

                    $s->entries = $s->entries->sortBy(['ledger.date', 'ledger.id']);
                    $prev = new \App\Models\LedgerEntry();

                    // Ensure current balance is right
                    // foreach ($s->entries as $index => $entry) {
                    //     if ($entry->credit) {
                    //         // Credit original use "+"
                    //         $entry->current_balance = $prev->current_balance - $entry->amount;
                    //     } else {
                    //         // Debit original use "-"
                    //         $entry->current_balance = $prev->current_balance + $entry->amount;
                    //     }
                    //     $prev = $entry;
                    // }


                    $temp_entries = $s->entries->filter(function ($entry, $id) use ($date) {
                        
                        if (!empty($entry->ledger->date)) {

                            $tempDate = strtotime($entry->ledger->date);
                            $convDate = date('Ymd', $tempDate);
                            
                            return $convDate >= $date[0]->format('Ymd') && $convDate <= $date[1]->format('Ymd');
                        } else {
                            return $entry;
                        }   
                    });

                    $s->entries = $s->entries->reverse();
                    $s->lastEntry = $s->entries->first();

                    $s->saldo_rata_rata = $temp_entries->pluck('current_balance')->avg();

                    if (empty($s->saldo_rata_rata)) {
                        $s->saldo_rata_rata = (\Cknow\Money\Money::parse(config('money.defaultCurrency') . $s->saldo))->formatByDecimal();
                    }
                });

                $item->saldo_rata_rata = $simpanan->pluck('saldo_rata_rata')->sum();

                // \Debugbar::info($simpanan->toArray());
            });

        } else {

            $componentList->map(function ($item, $i) use ($date) {
                $item->current_debits = \App\Models\LedgerEntry::where('debit', '=', 1)
                    ->where('ledgerable_type' ,'=', 'App\Models\AkunPerkiraan')
                    ->where('ledgerable_id', '=', $item->gl->id)
                    ->whereHas('ledger', function ($query) use ($date) {
                        $query->whereBetween('date', [
                            $date[0],
                            $date[1],
                        ]);
                    })
                    ->get()
                    ->pluck('amount')
                    ->sum();
    
                $item->current_credits = \App\Models\LedgerEntry::where('credit', '=', 1)
                    ->where('ledgerable_type' ,'=', 'App\Models\AkunPerkiraan')
                    ->where('ledgerable_id', '=', $item->gl->id)
                    ->whereHas('ledger', function ($query) use ($date) {
                        $query->whereBetween('date', [
                            $date[0],
                            $date[1],
                        ]);
                    })
                    ->get()
                    ->pluck('amount')
                    ->sum();
    
    
                $item->saldo = $item->current_credits - $item->current_debits;
            });

        }


        return view('bagi_hasil.setting.index', compact('allGL', 'componentList', 'currentMonth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KomponenBagiHasil::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KomponenBagiHasil::destroy($id);

        return back()->with('success', 'Proses hapus berhasil');
    }
}
