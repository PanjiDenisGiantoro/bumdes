<?php

namespace App\Http\Controllers;

use App\Models\JurnalEntry;
use App\Models\Ledger;
use Illuminate\Http\Request;

class JurnalEntryController extends Controller
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
        $ledgers = Ledger::with([
            'entries' => function ($query) {
                $query->with('ledgerable')
                    ->where('ledgerable_type', 'App\\Models\\AkunPerkiraan');
            }
        ])
            // ->filter($request->all())
            ->orderByRaw('date desc, journal_no desc')
            ->paginate(10);

        return view("semua_laporan.jurnal_entry.index", compact('ledgers'));
    }
//    public function index(Request $request)
//    {
//        if (empty($request->query('datefilter'))) {
//            $request->merge([
//                'datefilter' => implode(' - ', [
//                    now()->startOfMonth()->format('d/m/Y'),
//                    now()->endOfMonth()->format('d/m/Y'),
//                ]),
//            ]);
//        }
//
//        $dates = array_unique(explode(' - ', $request->query('datefilter')));
//        $ledgers = Ledger::with([
//            'entries' => function ($query) {
//                $query->with('ledgerable')
//                    ->where('ledgerable_type', 'App\\Models\\AkunPerkiraan');
//            }
//        ])
//            // ->filter($request->all())
//            ->orderByRaw('date desc, journal_no desc')
//            ->paginate(10);
//
//
//        return view("semua_laporan.jurnal_entry.index", compact('ledgers'));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("semua_laporan.jurnal_entry.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        JurnalEntry::create($request->all());

        return \redirect()
            ->route("semua_laporan.jurnal_entry.index")
            ->with("message", ("Pengajuan Jurnal Entry Berhasil"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function show(JurnalEntry $jurnal_entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function edit(JurnalEntry $jurnal_entry)
    {
        return view("jurnal_entry.form", \compact("jurnal_entry"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JurnalEntry $jurnal_entry)
    {
        $jurnal_entry->fill($request->all());

        $jurnal_entry->save();

        return redirect()
            ->route("jurnal_entry.index")
            ->with("message",("Perbaharui Jurnal Entry Berhasil"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembiayaan  $pembiayaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurnalEntry $jurnal_entry)
    {
        //
    }
}
