<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\JurnalKeuangan;
use App\Models\Ledger;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ledgers = Ledger::with('entries.ledgerable')
            ->when($request->route()->getName() == 'jurnal_keuangan.index', function ($query) {
                $query->where('type', 'JN');
            })
            ->paginate(10);

        return view("jurnal_keuangan.index", compact('ledgers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last = Ledger::where('type', 'JN')->orderBy('journal_no', 'DESC')->first();

        return view("jurnal_keuangan.form", compact('last'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $request->merge([
                'type' => 'JN',
            ]);

            $ledger = Ledger::create($request->except('_token'));

            foreach ($request->entries as $entry) {
                $account = AkunPerkiraan::find($entry['ledgerable_id']);

                if (!empty($entry['nominal_kredit'])) {
                    $amount = money_parse_by_decimal(str_replace(',', '', $entry['nominal_kredit']), config('money.defaultCurrency'));
                    $entry  = \App\Facades\Ledger::credit($account, null, $amount->formatByDecimal(), config('money.defaultCurrency'), $ledger->description,$ledger->id);
                } else {
                    $amount = money_parse_by_decimal(str_replace(',', '', $entry['nominal_debet']), config('money.defaultCurrency'));
                    $entry  = \App\Facades\Ledger::debit($account, null, $amount->formatByDecimal(), config('money.defaultCurrency'), $ledger->description,$ledger->id);
                }

                if (!empty($entry)) {
                    $entry->ledger_id = $ledger->id;

                    $entry->save();
                }
            }

            DB::commit();

            return redirect()
                ->route('jurnal_keuangan.index')
                ->with('success', 'Transaksi berhasil');
        } catch (Exception $ex) {
            DB::rollback();

            return redirect()
                ->route('jurnal_keuangan.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ledger  $jurnal_keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ledger $jurnal_keuangan)
    {
        $readOnly = true;

        return view("jurnal_keuangan.form", compact('jurnal_keuangan', 'readOnly'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(JurnalKeuangan $jurnal_keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JurnalKeuangan $jurnal_keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warung  $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(JurnalKeuangan $jurnal_keuangan)
    {
        //
    }
}
