<?php

namespace App\Http\Controllers;

use App\Models\AkunPerkiraan;
use App\Models\Anggota;
use App\Models\JenisTransaksi;
use App\Models\Ledger;
use App\Models\LedgerEntry;
use App\Models\ProdukRekeningPembiayaan;
use App\Models\Rekening;
use App\Models\RekeningPembiayaan;
use App\Models\RekeningPendanaan;
use App\Models\RekeningSimjaka;
use App\Models\RekeningSimpanan;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PemindahbukuanController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        $last = Ledger::where('type', '=', 'PB')->orderBy('created_at', 'DESC')->get();
        if (count($last) > 0) {
            $last = $last[0]->journal_no;
        } else {
            $last = 1;
        }
        return view('pemindahbukuan.index', compact('anggota', 'last'));
    }

    public function store(Request $request)
    {

        $akunpembayar = RekeningSimpanan::with('produk', 'anggota')->findOrFail($request->akun);
        $coa = AkunPerkiraan::findOrFail($akunpembayar->produk->GL_produk_simpanan);
        $akunpenerima1 = Rekening::with('produk')->where('id', $request->akun_id_penerima)->first();

        if ($akunpenerima1->rekening_type == 'App\Models\RekeningPembiayaan') {
            $akunpenerima = RekeningPembiayaan::with('produk')->find($request->akun_id_penerima);
            $coaPenerima = AkunPerkiraan::findOrFail($akunpenerima->produk->GL_produk_pembiayaan);
        } elseif ($akunpenerima1->rekening_type == 'App\Models\RekeningSimjaka') {
            $akunpenerima = RekeningSimjaka::with('produk')->find($request->akun_id_penerima);
            $coaPenerima = AkunPerkiraan::findOrFail($akunpenerima->produk->GL_produk_simpanan);
        } else {
            $akunpenerima = RekeningSimpanan::with('produk')->find($request->akun_id_penerima);
            $coaPenerima = AkunPerkiraan::findOrFail($akunpenerima->produk->GL_produk_simpanan);
        }
        $marginTangguhAccount = ProdukRekeningPembiayaan::where('kategori_produk', '=', 'pembiayaan')
            ->where('id', $akunpenerima->produk_id)
            ->where('GL_ditangguhkan', $akunpenerima->produk->GL_ditangguhkan)
            ->first();

        $marginAccount = ProdukRekeningPembiayaan::where('kategori_produk', '=', 'pembiayaan')
            ->where('id', $akunpenerima->produk_id)
            ->where('GL_basil', $akunpenerima->produk->GL_basil)
            ->first();

        $nominal = Money::parse(str_replace(',', '', $request->nominal ?? 0), config('money.defaultCurrency'));

        $marginAmount = Money::parse(config('money.defaultCurrency') . ($request->margin ?? 0));
        $last = Ledger::where('type', '=', 'PB')->orderBy('created_at', 'DESC')->count();

        DB::beginTransaction();
        if ($akunpenerima1->rekening_type == 'App\Models\RekeningPembiayaan') {
            $description = 'Pemindahbukuan dari' . ' ' . $akunpembayar->noakun ?? '' . ' - ' . $akunpembayar->produk->nama_pembiayaan . ' ' . $akunpembayar->anggota->nama_pemohon . ' Ke ' . $akunpenerima->noakun . ' - ' . $akunpenerima->produk->nama_pembayaran . ' ' . $akunpenerima->anggota->nama_pemohon;
        } elseif ($akunpenerima1->rekening_type == 'App\Models\RekeningSimjaka') {
            $description = 'Pemindahbukuan dari' . ' ' . $akunpembayar->noakun ?? '' . ' - ' . $akunpembayar->produk->nama_simpanan . ' ' . $akunpembayar->anggota->nama_pemohon . ' Ke ' . $akunpenerima->noakun . ' - ' . $akunpenerima->produk->nama_simpanan . ' ' . $akunpenerima->anggota->nama_pemohon;
        } else {
            $description = 'Pemindahbukuan dari' . ' ' . $akunpembayar->noakun ?? '' . ' - ' . $akunpembayar->produk->nama_simpanan . ' ' . $akunpembayar->anggota->nama_pemohon . ' Ke ' . $akunpenerima->noakun . ' - ' . $akunpenerima->produk->nama_simpanan . ' ' . $akunpenerima->anggota->nama_pemohon;
        }
        try {
            $request->merge([
                'type' => 'PB',
                'date' => $request->date,
                'nominal' => $nominal->formatByDecimal(),
                'margin' => $marginAmount->formatByDecimal(),
                'penerima' => $request->penerima,
                'akun_penerima' => $request->akun_id_penerima,
                'teller_transaction' => 1,
                'journal_no' => $last + 1,
                'description' => $description,
            ]);

            $ledger = Ledger::create($request->all());

            if (empty($marginAccount)) {
                $entry = \App\Facades\Ledger::debit($coa, $akunpembayar, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                $entry->save();
//
//            $entry = \App\Facades\Ledger::credit($coaPenerima,$akunpenerima , $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
//            $entry->save();

//            $entry = $akunpenerima->credit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
//            $entry->save();

                $entry = $akunpembayar->debit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                $entry->save();

            } else {

                $entry = \App\Facades\Ledger::debit($coa, $akunpembayar, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                $entry->save();
//
//                $entry = \App\Facades\Ledger::credit($coaPenerima,$akunpenerima , $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
//                $entry->save();

//                $entry = $akunpenerima->credit(null, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
//                $entry->save();

                $entry = $akunpembayar->debit(null, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                $entry->save();
            }
            if ($nominal->formatByDecimal() == '0.00') {
                if (empty($marginTangguhAccount)) {
                    $entry = $akunpenerima->credit(null, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();
                } else {
                    $entry = $akunpenerima->credit(null, $marginAmount->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();
                }
            } else {
                if (!empty($marginTangguhAccount)) {
                    $entry = $akunpenerima->credit(null, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();

                    $entry = \App\Facades\Ledger::credit($coaPenerima, $akunpenerima, $nominal->add($marginAmount)->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();
                } else {
                    $entry = $akunpenerima->credit(null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();
                    if (empty($marginAmount) || $marginAmount->formatByDecimal() == '0.00') {
                        $entry = \App\Facades\Ledger::credit($coaPenerima, $akunpenerima, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                        $entry->save();
                    }
                }
            }
            if (!empty($marginAccount) && $marginAmount->formatByDecimal() > 0) {
                $entry = \App\Facades\Ledger::debit($marginTangguhAccount->id, null, $marginAmount->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                $entry->save();


                if (empty($marginTangguhAccount)) {
                    if ($nominal->formatByDecimal() == '0.00') {
                        $entry = \App\Facades\Ledger::credit($akunpenerima, null, 0, config('money.defaultCurrency'), $request->description, $ledger->id);
                        $entry->save();
                    } else {
                        $entry = \App\Facades\Ledger::credit($akunpenerima, null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                        $entry->save();
                    }
                } else {
                    $entry = \App\Facades\Ledger::credit($akunpenerima, null, $nominal->formatByDecimal(), config('money.defaultCurrency'), $request->description, $ledger->id);
                    $entry->save();
                }
            }


            if ($akunpenerima1->rekening_type == 'App\Models\RekeningPembiayaan') {
                RekeningPembiayaan::where('id', $akunpenerima1->id)->update(['status' => 'aktif']);
            } elseif ($akunpenerima1->rekening_type == 'App\Models\RekeningSimjaka') {
                RekeningSimjaka::where('id', $akunpenerima1->id)->update(['status' => 'aktif']);
            } else {
                RekeningSimpanan::where('id', $akunpenerima1->id)->update(['status' => 'aktif']);
            }

            DB::commit();

            return redirect()
                ->route('pemindahbukuan.index')
                ->with('message', 'Transaksi berhasil');
        } catch (\Exception $ex) {
            DB::rollback();

            return back()
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }


    }

    public function laporan()
    {
//        rekening pembiayaan jadwal pembayaran
//        $allPembiayaan = RekeningPembiayaan::with('produk.akads', 'ledger', 'ledgerable', 'rekAutodebet.produk')->where('rek_autodebet', '!=', '')->get();
//        foreach ($allPembiayaan as $rekeningPembiayaan) {
//            $real = $rekeningPembiayaan->balance() - $rekeningPembiayaan->rekAutodebet->produk->saldo_mengendap;
//            $akads = $rekeningPembiayaan->produk->akads->jenis_akad;
//            if ($akads == 'murabahah' || $akads == 'musyarakah' || $akads == 'qard' ) {
//                foreach ($rekeningPembiayaan->jadwal as $values) {
//                    $outstandingsekarang = !empty($rekeningPembiayaan->saldo) ? $rekeningPembiayaan->saldo + (!empty($values['sisaMargin']) ? $values['sisaMargin'] : 0) : (!empty($values['sisaMargin']) ? $values['sisa_margin'] : 0);
//                    $tunggakan = $outstandingsekarang - $values['oustanding'];
//                    $selisihTunggakan = $tunggakan / $values['angsuranBulanan'];
//
////                    ddd($values);
//                    if ($values['tanggalAngsuran'] == now()) {
//                        if ($outstandingsekarang < $values['outstanding']){
//                            if ($selisihTunggakan == 1){
//                                if($real >= $values['angsuranBulanan']){
////                                    proses
//                                }elseif($real < $values['angsuranBulanan']){
////                                    proses
//                                }
//                            }elseif ($selisihTunggakan <= 1){
//
//
//                            }
//                        }else{
//
//                        }
//                    }
//
//
//                }
//            } elseif ($akads == 'mudharabah' || $akads == 'ijarah') {
//                foreach ($rekeningPembiayaan->jadwal as $values) {
//                    ddd($rekeningPembiayaan->jadwal);
//
//                    if ($values['tanggalAngsuran'] == now()) {
//                        ddd('r');
//                    } else {
//                        ddd('sdfs');
//                    }
//                }
//            }
//        }
        $ledgers = Ledger::with([
            'entries' => function ($query) {
                $query
                    ->with('ledgerable')
                    ->where('ledgerable_type', 'App\\Models\\RekeningSimpanan')
                    ->where('ledgerable_type', 'App\\Models\\RekeningSimjaka')
                    ->where('ledgerable_type', 'App\\Models\\RekeningPembiayaan');
            },
        ])
            ->where('type', 'PB')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('pemindahbukuan.laporan', compact('ledgers'));
    }
}
