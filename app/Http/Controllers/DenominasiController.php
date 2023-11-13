<?php

namespace App\Http\Controllers;

use App\Models\Denominasi;
use Illuminate\Http\Request;
use App\Models\AkunPerkiraan;
use App\Models\KodeProfil;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DenominasiController extends Controller
{
    public function index()
    {
        $denominasi = Denominasi::orderBy('created_at', 'desc')->get();

        return view('teller.denominasi.index', compact('denominasi'));
    }

    public function create()
    {
        $akun = AkunPerkiraan::where('kode','like','0%')->orderBy('_lft','ASC')->get();

        // ddd($akun);
        return view('teller.denominasi.form', [
            'akun' => $akun,
        ]);
    }

    public function store(Request $request)
    {
        // ddd($request->all());
        DB::beginTransaction();

        try {
            $request->merge([
                'total_amount' => str_replace(',', '', $request->total_amount),
            ]);
            // ddd(str_replace(',', '', $request->total_amount));x

            Denominasi::create($request->except(['_token']));


            $user = auth()->user()->id;
            $datauser = User::find($user);
            $profil = KodeProfil::find($datauser->profil_id);
            $jenis_alokasi = AkunPerkiraan::find($profil->penampung_id);

            // ddd($jenis_alokasi);

            $coa1 = AkunPerkiraan::find($jenis_alokasi->id);
            $coa2 = AkunPerkiraan::find($request->lejer);

            // ddd($coa1);
            // $gl = '';
            // if (user punya gl atau tidak) {
            //     $gl = //setgl
            // } else {
            //     $gl = AkunPerkiraan::find('14');

            // }

            $nominal = 0;

            foreach ([100, 200, 500, 1000, 2000, 5000, 10000, 20000, 50000, 75000, 100000] as $i => $deno) {
                $nominal += str_replace(',', '', $request->{"value_$deno"});
            }

            // $request->merge();

            // dump($request->all());

            $lejerfindid = AkunPerkiraan::find($request->lejer);
            $lejername = $lejerfindid->nama;

            $ledger = \App\Models\Ledger::create([
                'type' => 'TN',
                'reference' => 'denominasi',
                'date' => \Carbon\Carbon::now()->setTimezone('WIB'),
                'description' => $request->jenis_transaksi .' '. 'Denominasi' .' '. $lejername,
                'nominal' => $request->total_amount, 
            ]);

            if ($request->jenis_operasi == 'debit') {

                $entry = \App\Facades\Ledger::debit($coa1, $coa2, $request->total_amount, config('money.defaultCurrency'), $request->keterangan, $ledger->id);
                $entry->save();

                // ddd('success');

                $entry = \App\Facades\Ledger::credit($coa2, $coa1, $request->total_amount, config('money.defaultCurrency'), $request->keterangan, $ledger->id);
                $entry->save();
            }

            if ($request->jenis_operasi == 'kredit') {
                $entry = \App\Facades\Ledger::credit($coa1, $coa2, $request->total_amount, config('money.defaultCurrency'), $request->keterangan, $ledger->id);
                $entry->save();

                $entry = \App\Facades\Ledger::debit($coa2, $coa1, $request->total_amount, config('money.defaultCurrency'), $request->keterangan, $ledger->id);
                $entry->save();
            }

            DB::commit();

            return redirect()
                ->route('denominasi.index')
                ->with('success','Denominasi telah di register');
        }  catch (\Exception $ex) {
            DB::rollback();

            Log::debug($ex);
                
            return redirect()
                ->route('denominasi.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }
    }
}
