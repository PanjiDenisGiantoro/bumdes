<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\Bank;
use App\Models\JenisTransaksi;
use App\Models\JurnalKeuangan;
use App\Models\Ledger;
use App\Models\PemetaanAkun;
use App\Models\RekeningSimpanan;
use App\Models\Supplier;
use App\Models\TerminPenjualan;
use Cknow\Money\Money;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ledgers = Ledger::with('entries.ledgerable')
            ->when($request->route()->getName() == 'biaya.index', function ($query) {
                $query->where('type', 'BN');
            })
            ->paginate(10);

        return view("biaya.index", compact('ledgers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last = Ledger::where('type', 'BN')->orderBy('journal_no', 'DESC')->first();
        $akun = AkunPerkiraan::all();
        $supplier = Supplier::all();
        $termin = TerminPenjualan::all();
        $pemetaan = PemetaanAkun::first();
        $bank = Bank::all();

        $anggota = Anggota::all();
        return view("biaya.form", compact('anggota','bank','pemetaan','last','akun','supplier','termin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        $request->validate([
//            'akun'            => 'required',
//            'jenis_transaksi' => 'required',
//            'description'     => 'required',
//        ]);

//        $rekening        = RekeningSimpanan::findOrFail($request->akun);
        $kas = PemetaanAkun::where('id','=',1)->first();

        $akun_produk     = AkunPerkiraan::findOrFail($request->akun);
        $jenis = AkunPerkiraan::findOrFail($request->jenis_transaksi);

        $nominal         = Money::parse(str_replace(',', '', $request->nominal), config('money.defaultCurrency'));

        DB::beginTransaction();

        try {
            if ($jenis->biaya_tunai == $request->jenis_transaksi)
            {
                $request->merge([
                    'type'               => 'BN',
                    'nominal'            => $nominal->formatByDecimal(),
                    'teller_transaction' => 1,
                    'description' => 'Biaya Pengeluaran Tunai -'.$request->description
                ]);
            }else{
                $request->merge([
                    'type'               => 'BN',
                    'nominal'            => $nominal->formatByDecimal(),
                    'teller_transaction' => 1,
                    'description' => 'Biaya Pengeluaran Non Tunai -'.$request->description

                ]);
            }


            $ledger = Ledger::create($request->all());

//            $rekeningUpdate = RekeningSimpanan::where('no_akun',$rekening->no_akun)->update(['status_aktif' => 'aktif']);

                if ($kas->GL_biaya_tunai == 'on') {
                // $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description);
                $entry = \App\Facades\Ledger::credit($jenis, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description,$ledger->id);
                $entry->ledger_id = $ledger->id;
                $entry->save();

                $entry = \App\Facades\Ledger::debit($akun_produk, $jenis, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description,$ledger->id);
                $entry->ledger_id = $ledger->id;
                // $entry->no_rek = $rekening->no_akun;
                $entry->save();
            } else {
                $entry = \App\Facades\Ledger::debit($jenis, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description,$ledger->id);
                $entry->ledger_id = $ledger->id;
                $entry->save();

                $entry = \App\Facades\Ledger::credit($akun_produk, $jenis, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description,$ledger->id);
                $entry->ledger_id = $ledger->id;
                // $entry->no_rek = $rekening->no_akun;
                $entry->save();
            }
            DB::commit();

            return redirect()
                ->route('biaya.index')
                ->with('message', 'Transaksi berhasil');
        } catch (\Exception $ex) {
            Log::debug($ex);

            DB::rollback();

            return redirect()
                ->route('biaya.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }

            }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ledger  $jurnal_keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $ledgers = Ledger::with('entries.ledgerable')
            ->when($request->route()->getName() == 'biaya.index', function ($query) {
                $query->where('type', 'BN');
            })->find($id);
        $jurnal_keuangan = Ledger::with('entries')->find($id);
//        ddd($jurnal_keuangan);
        $readOnly = true;
        $last = Ledger::where('type', 'BN')->orderBy('journal_no', 'DESC')->first();
        $akun = AkunPerkiraan::all();
        $supplier = Supplier::all();
        $termin = TerminPenjualan::all();
        $pemetaan = PemetaanAkun::first();
        $anggota = Anggota::all();

        return view("biaya.show", compact('anggota','ledgers','pemetaan','jurnal_keuangan', 'readOnly','akun','supplier','termin'));
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
