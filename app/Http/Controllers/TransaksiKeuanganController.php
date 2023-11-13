<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\JenisTransaksi;
use App\Models\KodePerusahaan;
use App\Models\Ledger;
use App\Models\LedgerEntry;
use App\Models\PemetaanAkun;
use App\Models\RekeningPembiayaan;
use App\Models\RekeningPendanaan;
use App\Models\RekeningSimjaka;
use App\Models\RekeningSimpanan;
use App\Models\TransaksiKeuangan;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $dataAnggota = Anggota::filter($request->all())
                ->with('rekenings', function ($query) {
                    return $query->where('status', '!=', \App\Models\RekeningSimpanan::STATUS_PENDING)
                        ->where('status', '!=', \App\Models\RekeningPembiayaan::STATUS_REJECTED)
                        ->with('produk');
                })
                ->with('rekeningSimjaka', function ($query) {
                    return $query->where('status', '!=', \App\Models\RekeningPembiayaan::STATUS_PENDING)
                        ->where('status', '!=', \App\Models\RekeningPembiayaan::STATUS_REJECTED)
                        ->with('produk');
                })
                ->with('rekeningPembiayaan', function ($query) {
                    return $query->where('status', '!=', \App\Models\RekeningPembiayaan::STATUS_PENDING)
                        ->where('status', '!=', \App\Models\RekeningPembiayaan::STATUS_REJECTED)
                        ->with('produk');
                })
                ->with('rekeningPendanaan.pendanaan')
                ->first();

            return response()->json(['results' => $dataAnggota]);
        }

        $ledgers = Ledger::with([
            'entries' => function ($query) {
                $query
                    ->with('ledgerable')
                    ->where('ledgerable_type', 'App\\Models\\RekeningSimpanan');
            },
        ])
            ->where('type', 'TN')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('teller.transaksi_keuangan.index', compact('ledgers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $company = KodePerusahaan::first();
        $anggota = Anggota::all();
        // $anggota = DB::table('anggotas')->join('rekening', 'anggotas.id', '=', 'rekening.anggota_id')
        //     ->select('anggotas.id as id', 'anggotas.nama_pemohon as nama_pemohon')
        //     ->where('status', '=', 'disetujui')
        //     ->orWhere('status', '=', 'aktif')
        //     ->groupBy('anggotas.id')
        //     ->get();
        // $last = Ledger::with('entries.ledgerable')->where('type', 'TN')->orderBy('journal_no', 'DESC')->first();
        $last = Ledger::where('type', '=', 'TN')->orderBy('created_at', 'DESC')->get();
        
        if (count($last) > 0) {
            $last = $last[0]->journal_no;
        } else {
            $last = 1;
        }


        return view("teller.transaksi_keuangan.form", compact('last', 'company', 'anggota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'akun_id' => 'required',
            'jenis_transaksi' => 'required',
            'description' => 'required',
        ]);

        $jenis = DB::table('rekening')->where('id', $request->akun_id)->first();
        if ($jenis->rekening_type == 'App\Models\RekeningSimpanan') {
            $rekening = RekeningSimpanan::findOrFail($request->akun_id);
            $akun_produk = AkunPerkiraan::findOrFail($rekening->produk->GL_produk_simpanan);
            $jenis_transaksi = JenisTransaksi::findOrFail($request->jenis_transaksi);
            $nominal = Money::parse(str_replace(',', '', $request->nominal), config('money.defaultCurrency'));

        } else if ($jenis->rekening_type == 'App\Models\RekeningSimjaka') {
            $rekening = RekeningSimjaka::where('id', $request->akun_id)->with('produk')->first();
            $akun_produk = AkunPerkiraan::findOrFail($rekening->produk->GL_produk_simpanan);
            $jenis_transaksi = JenisTransaksi::findOrFail($request->jenis_transaksi);
            $nominal = Money::parse(str_replace(',', '', $request->nominal), config('money.defaultCurrency'));
            
        } else if ($jenis->rekening_type == 'App\Models\RekeningPendanaan') {
            $rekening = RekeningPendanaan::findOrFail($request->akun_id);
            $pemetaan = PemetaanAkun::where('id', 1)->first();
            $akun_produk = AkunPerkiraan::findOrFail($pemetaan->pendanaan);
            $jenis_transaksi = JenisTransaksi::findOrFail($request->jenis_transaksi);
            $nominal = Money::parse(str_replace(',', '', $request->nominal), config('money.defaultCurrency'));

        } else {
            $rekening = RekeningPembiayaan::findOrFail($request->akun_id);
            $akun_produk = AkunPerkiraan::findOrFail($rekening->produk->GL_produk_pembiayaan);
            $jenis_transaksi = JenisTransaksi::findOrFail($request->jenis_transaksi);
            $nominal = Money::parse(str_replace(',', '', $request->nominal), config('money.defaultCurrency'));
            $marginAmount = Money::parse($rekening->interest ?? 0, config('money.defaultCurrency'));

            $marginTangguhAccount = \App\Models\AkunPerkiraan::where('id', '=', $rekening->produk->GL_ditangguhkan)->first();

        }


        $marginInput = Money::parse(str_replace(',', '', $request->margin ?? 0), config('money.defaultCurrency'));
        

        DB::beginTransaction();

        try {
            $request->merge([
                'type' => 'TN',
                'nominal' => $nominal->formatByDecimal(), // nominal + margin disini -Arrave
                'margin' => $marginInput->formatByDecimal(),
                'teller_transaction' => 1,
                'anggota_id' => $request->anggota,
            ]);

            if ($jenis->rekening_type == 'App\Models\RekeningSimpanan') {
                $rekeningUpdate = RekeningSimpanan::where('no_akun', $rekening->no_akun)->update(['status' => 'aktif']);
            } else if ($jenis->rekening_type == 'App\Models\RekeningSimjaka') {
                $rekeningSimjaka = RekeningSimjaka::where('id', '=', $rekening->id)->first(); // Grab rekening
            } else if ($jenis->rekening_type == 'App\Models\RekeningPendanaan') {
                $rekeningUpdate = RekeningPendanaan::where('no_akun', $rekening->no_akun)->update(['status' => 'aktif']);
            } else {
                // RekeningPembiayaan::where('id', '=', $rekening->id)->update(['status' => 'aktif']);
                $rekeningPembiayaan = RekeningPembiayaan::where('id', '=', $rekening->id)->first(); //update status & stuff *cant perform on observer* -Arrave 31/3/22
            }

            $ledger = Ledger::create($request->all());

            if ($jenis_transaksi->macam_transaksi == 'simpanan' ) {
                if ($jenis_transaksi->kredit == 'on') { // Keluar uang dari rekening
                    // $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description);
                    $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;
                    $entry->save();

                    $entry = \App\Facades\Ledger::debit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;
                    $entry->save();

                    $entry = $rekening->debit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;
                    $entry->save();

                } else { // Masuk Uang kedalam rekening
                    $entry = \App\Facades\Ledger::debit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;
                    $entry->save();

                    $entry = \App\Facades\Ledger::credit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;
                    $entry->save();

                    $entry = $rekening->credit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;
                    $entry->save();
                }
            } else if ( $jenis_transaksi->macam_transaksi == 'simpananberjangka' || $jenis_transaksi->macam_transaksi == 'simjaka') {
                if ($jenis_transaksi->kredit == 'on') { // Keluar uang dari rekening
                    $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                    $entry = \App\Facades\Ledger::debit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                    $entry = $rekening->debit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                } else { // Masuk Uang kedalam rekening
                    // Check status and set disetujui->active.. Ignore if status already active - Arrave 15/5/22
                    if ($rekeningSimjaka->status == 'disetujui') {
                        $rekeningSimjaka->status = \App\Models\RekeningSimpanan::STATUS_ACTIVE;
                        $rekeningSimjaka->save();
                    }
                    
                    $entry = \App\Facades\Ledger::debit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                    $entry = \App\Facades\Ledger::credit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                    $entry = $rekening->credit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();
                }
            } else if ($jenis_transaksi->macam_transaksi == 'pendanaan') {
                if ($jenis_transaksi->kredit == 'on') {
                    // $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description);
                    $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                    $entry = \App\Facades\Ledger::debit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                    $entry = $rekening->debit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();
                    $update = LedgerEntry::where('ledger_id', $ledger->id)->update(['ledger_id' => $rekening->no_akun]);
                } else {
                    $entry = \App\Facades\Ledger::debit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;

                    $entry->save();

                    $entry = \App\Facades\Ledger::credit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);

                    // $entry->no_rek = $rekening->no_akun;
                    $entry->save();

                    $entry = $rekening->credit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->ledger_id = $ledger->id;
                    $entry->save();
                }
            } else {

                // Transaksi pembiayaan -Arrave

                $pendapatanPembiayaanAccount = \App\Models\AkunPerkiraan::where('id', '=', $rekening->produk->GL_basil)->first();

                switch ($jenis_transaksi->kredit) {

                    case 'off': // Debit // Pembayaran cicilan

                        if (!empty($marginTangguhAccount)) { //Cicilan Murabahah
                            $entry = \App\Facades\Ledger::debit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            // Bayar margin sahaja || bayar pokok & margin
                            if ($marginInput->formatByDecimal() != '0.00') {
                                $entry = \App\Facades\Ledger::debit($marginTangguhAccount, $pendapatanPembiayaanAccount, $marginInput->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                                // $entry->ledger_id = $ledger->id;
                                $entry->save();

                                $entry = \App\Facades\Ledger::credit($pendapatanPembiayaanAccount, $marginTangguhAccount, $marginInput->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                                // $entry->ledger_id = $ledger->id;
                                $entry->save();
                            }

                            $entry = $rekening->credit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                        } else { //Cicilan Mudharabah
                            // $entry = \App\Facades\Ledger::debit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->subtract($marginInput)->formatByDecimal(), config('money.defaultCurrency'), $request->description);
                            $entry = \App\Facades\Ledger::debit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            //Bayar margin sahaja
                            if ($request->nominal == $request->margin) {
                                $entry = \App\Facades\Ledger::credit($pendapatanPembiayaanAccount, $jenis_transaksi->akun_perkiraan, $marginInput->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                                // $entry->ledger_id = $ledger->id;
                                $entry->save();

                                //Bayar pokok sahaja
                            } else if ($marginInput->formatByDecimal() == '0.00') {
                                $entry = \App\Facades\Ledger::credit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->subtract($marginInput)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                                // $entry->ledger_id = $ledger->id;
                                $entry->save();

                                // Bayar dua dua pokok dan margin
                            } else {
                                $entry = \App\Facades\Ledger::credit($pendapatanPembiayaanAccount, $jenis_transaksi->akun_perkiraan, $marginInput->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                                // $entry->ledger_id = $ledger->id;
                                $entry->save();

                                $entry = \App\Facades\Ledger::credit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->subtract($marginInput)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                                // $entry->ledger_id = $ledger->id;
                                $entry->save();

                            }

                            $entry = $rekening->credit(null, $nominal->subtract($marginInput)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();
                        }
                        break;

                    case 'on': // Kredit // Pencairan

                        $rekeningPembiayaan->status = \App\Models\RekeningPembiayaan::STATUS_ACTIVE;
                        $rekeningPembiayaan->tanggal_aktif = \Carbon\Carbon::now()->format('Y-m-d');
                        $rekeningPembiayaan->tanggal_jatuh_tempo = \Carbon\Carbon::now()->addMonths($rekeningPembiayaan->jangka_waktu)->format('Y-m-d');
                        $rekeningPembiayaan->save();

                        if (!empty($marginTangguhAccount)) {

                            $entry = \App\Facades\Ledger::debit($akun_produk, null, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($marginTangguhAccount, $akun_produk, $marginAmount->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = $rekening->debit(null, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                        } else {

                            $entry = \App\Facades\Ledger::credit($jenis_transaksi->akun_perkiraan, $akun_produk, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = \App\Facades\Ledger::debit($akun_produk, $jenis_transaksi->akun_perkiraan, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();

                            $entry = $rekening->debit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                            // $entry->ledger_id = $ledger->id;
                            $entry->save();
                        }
                        break;
                }
            }

            DB::commit();

            return redirect()
                ->route('transaksi_keuangan.index')
                ->with('message', 'Transaksi berhasil');
        } catch (\Exception $ex) {
            Log::debug($ex);

            DB::rollback();

            return redirect()
                ->route('teller.transaksi_keuangan.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Ledger $transaksi_keuangan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $transaksi_keuangan = Ledger::with([
            'entries' => function ($query) {
                $query
                    ->with('ledgerable');
            },
        ])->find($id);
        // dd($transaksi_keuangan->rekening);
        $readOnly = true;
        $anggota = DB::table('anggotas')->join('rekening', 'anggotas.id', '=', 'rekening.anggota_id')
            ->select('anggotas.id as id', 'anggotas.nama_pemohon as nama_pemohon')
            ->groupBy('anggotas.id')
            ->get();
        // dd($anggota);
        return view("teller.transaksi_keuangan.show", \compact('transaksi_keuangan', 'readOnly', 'anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiKeuangan $transaksi_keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransaksiKeuangan $transaksi_keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Warung $warung
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiKeuangan $transaksi_keuangan)
    {
        //
    }
}
