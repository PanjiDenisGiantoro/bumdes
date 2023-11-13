<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\RingkasanBank;
use Illuminate\Http\Request;

class RingkasanBankController extends Controller
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

        $akuns = AkunPerkiraan::where('jenis', 'A')
            ->with([
                'descendants' => function ($query) use ($dates) {
                    $query
                        // ->whereLike('nama', "%bank%")
                        ->withDepth()
                        ->having('depth', 2)
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

        $akuns->map(function ($akun) {
            $akun->descendants->map(function ($descendant) {
                $descendant->_debit = $descendant->entries->reduce(function ($carry, $entry) {
                    if ($entry->credit) return $carry;
            
                    return $carry + $entry->amount;
                });

                $descendant->_credit = $descendant->entries->reduce(function ($carry, $entry) {
                    if ($entry->debit) return $carry;
            
                    return $carry + $entry->amount;
                });

                $descendant->_balance = $descendant->_debit - $descendant->_credit;
            });

            $akun->_debit   = $akun->descendants->pluck('_debit')->sum();
            $akun->_credit  = $akun->descendants->pluck('_credit')->sum();
            $akun->_balance = $akun->_debit - $akun->_credit;
        });

        return view("semua_laporan.ringkasan_bank.index", compact('akuns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.ringkasan_bank.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RingkasanBank::create($request->all());

        return \redirect()
            ->route("semua_laporan.ringkasan_bank.index")
            ->with("success", __("Pengajuan Ringkasan Bank Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(RingkasanBank $ringkasan_bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(RingkasanBank $ringkasan_bank)
    {
        return view("ringkasan_bank.form", \compact("ringkasan_bank"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RingkasanBank $ringkasan_bank)
    {
        $ringkasan_bank->fill($request->all());

        $ringkasan_bank->save();

        return redirect()
            ->route("ringkasan_bank.index")
            ->with("success", __("Perbaharui Ringkasan Bank Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RingkasanBank $ringkasan_bank)
    {
        //
    }
}
