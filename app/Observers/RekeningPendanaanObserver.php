<?php

namespace App\Observers;

use App\Models\DaftarPembiayaan;
use App\Models\RekeningPendanaan;
use App\Models\Ledger;
use App\Models\LedgerEntry;

use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RekeningPendanaanObserver
{
    /**
     * Handle the RekeningPendanaan "created" event.
     *
     * @param  \App\Models\RekeningPendanaan  $rekeningPendanaan
     * @return void
     */
    public function created(RekeningPendanaan $rekeningPendanaan)
    {

        $amountPendanaan    = Money::parse($rekeningPendanaan->pendanaan->nominal_dana ?? 0, config('money.defaultCurrency'));
        $pendapatanKoperasi = Money::parse($rekeningPendanaan->pendanaan->biaya_pendapatan_koperasi ?? 0, config('money.defaultCurrency'));
        $adminPendana       = Money::parse($rekeningPendanaan->pendanaan->biaya_admin_pendana ?? 0, config('money.defaultCurrency'));
        $titipanPendana     = Money::parse($rekeningPendanaan->pendanaan->biaya_hutang_margin ?? 0, config('money.defaultCurrency'));

        $amountInterest         = $pendapatanKoperasi->add($adminPendana);
        $amountPokokSimpanan    = $amountPendanaan->subtract($amountInterest);
        $amountPembiayaan       =  $amountPokokSimpanan->add($amountInterest)->add($titipanPendana);

        $GL_simpanan            = $rekeningPendanaan->pendanaan->produk_simpanan->akun_perkiraans;
        $GL_pembiayaan          = \App\Models\AkunPerkiraan::where('id', '=', $rekeningPendanaan->pendanaan->gl_pembiayaan_pendanaan)->first();
        $GL_pendapatanKoperasi  = \App\Models\AkunPerkiraan::where('id', '=', $rekeningPendanaan->pendanaan->gl_pendapatan_koperasi)->first();
        $GL_adminPendana        = \App\Models\AkunPerkiraan::where('id', '=', $rekeningPendanaan->pendanaan->gl_admin_pendana)->first();
        $GL_titipanPendana      = \App\Models\AkunPerkiraan::where('id', '=', $rekeningPendanaan->pendanaan->gl_hutang_margin)->first();

        // Get pengajuan pendaan row
        $pengajuanPendanaan = DaftarPembiayaan::where('id', '=', $rekeningPendanaan->rek_transfer_basil)->first();

        // Get rekening simpanan pendanaan
        $wadahSimpanan = $rekeningPendanaan->pendanaan->produk_simpanan;
        

        $rekeningSimpanan = \App\Models\RekeningSimpanan::where('produk_id', '=', $rekeningPendanaan->pendanaan->produk_simpanan->id)
            ->where('anggota_id', '=', $rekeningPendanaan->anggota_id)
            ->first();

        if ($rekeningSimpanan == null) {

            // Penomoran auto panji
            $auto = \App\Models\PenomoranAuto::where('keterangan', '=', 'simpanan')->first();
            $count = \App\Models\RekeningSimpanan::count() + 1;
            if (!empty($auto->format_depan)) {
                $format_depan =date($auto->format_depan);
            } else {
                $format_depan = '';
            }
            if (!empty($auto->format_tengah)) {
                $format_tengah = date($auto->format_tengah);
            } else {
                $format_tengah = '';
            }
            if (!empty($auto->format_belakang)) {
                $format_belakang = date($auto->format_belakang);
            } else {
                $format_belakang = '';
            }
            $no = $auto->head.$auto->kode_perusahaan.$auto->kode_cabang.$wadahSimpanan->kode_simpanan.$format_depan.$format_tengah.$format_belakang.sprintf("%05s", $count);
            $text = str_replace(' ', '', $no);


            $rekeningSimpanan = \App\Models\RekeningSimpanan::create([
                'rekening_type' => 'App\Models\RekeningSimpanan',
                'anggota_id' => $rekeningPendanaan->anggota_id,
                'no_akun' => $text,
                'pilihan_akad' => $rekeningPendanaan->pendanaan->produk_simpanan->akad_simpanan,
                'produk_id' => $rekeningPendanaan->pendanaan->produk_simpanan->id,
                'nilai_setoran' => $amountPokokSimpanan->formatByDecimal(),
                'tujuan_pengajuan' => '',
                'status' => 'aktif',
            ]);
        }
        
        $pengajuanPendanaan->rekening_simpanan_dana_id = $rekeningSimpanan->id;
        $pengajuanPendanaan->save();

        DB::beginTransaction();

        try {
            $lasts = Ledger::with('entries.ledgerable')->where('type', 'TN')->orderBy('journal_no', 'DESC')->first();
            // $jNo =  'TN-'.str_pad(($lasts->journal_no ?? 0) + 1, 4, 0, STR_PAD_LEFT);
            
            $ledger = Ledger::create([
                'type' => 'TN',
                'date' => now(),
                'journal_no' => str_pad(($lasts->journal_no ?? 0) + 1, 4, 0, STR_PAD_LEFT),
                // 'journal_no' => '44',
                'reference' => 'Pendanaan',
                'description' => 'Pencairan Pendanaan',
                'status' => '0',
                'akun' => $rekeningPendanaan->id,
                // 'akun' => '2',
                'anggota_id' => $rekeningPendanaan->anggota->id,
                'jenis_transaksi' => '4',
                'nominal' => $amountPembiayaan->formatByDecimal(),
                'margin' => $amountInterest->formatByDecimal(),
                'created_by' => 1,
                'updated_by' => 1,
            ]);
            
            $entry = \App\Facades\Ledger::debit($GL_pembiayaan, $GL_simpanan, $amountPembiayaan->formatByDecimal(), config('money.defaultCurrency'), 'Pencairan pendanaan', $ledger->id);
            // $entry->ledger_id = $ledger->id;
            $entry->save();

            $entry = \App\Facades\Ledger::credit($GL_simpanan, $GL_pembiayaan, $amountPokokSimpanan->formatByDecimal(), config('money.defaultCurrency'), 'Pencairan pendanaan', $ledger->id);
            // $entry->ledger_id = $ledger->id;
            $entry->save();
            
            $entry = \App\Facades\Ledger::credit($GL_pendapatanKoperasi, $GL_pembiayaan, $pendapatanKoperasi->formatByDecimal(), config('money.defaultCurrency'), 'Pencairan pendanaan', $ledger->id);
            // $entry->ledger_id = $ledger->id;
            $entry->save();
            
            $entry = \App\Facades\Ledger::credit($GL_adminPendana, $GL_pembiayaan, $adminPendana->formatByDecimal(), config('money.defaultCurrency'), 'Pencairan pendanaan', $ledger->id);
            // $entry->ledger_id = $ledger->id;
            $entry->save();
            
            $entry = \App\Facades\Ledger::credit($GL_titipanPendana, $GL_pembiayaan, $titipanPendana->formatByDecimal(), config('money.defaultCurrency'), 'Pencairan pendanaan', $ledger->id);
            // $entry->ledger_id = $ledger->id;
            $entry->save(); 

            $entry = $rekeningPendanaan->debit(null, $amountPembiayaan->formatByDecimal(), config('money.defaultCurrency'), 'Pencairan pendanaan', $ledger->id);
            // $entry->ledger_id = $ledger->id;
            $entry->save();

            $last = Ledger::with('entries.ledgerable')->where('type', 'TN')->orderBy('journal_no', 'DESC')->first();
            // $lastJurnalNo = 'TN-'.str_pad(($last->journal_no ?? 0) + 1, 4, 0, STR_PAD_LEFT);

            $ledgerSimp = Ledger::create([
                'type' => 'TN',
                'date' => now(),
                'journal_no' => str_pad(($last->journal_no ?? 0) + 1, 4, 0, STR_PAD_LEFT),
                // 'journal_no' => '44',
                'reference' => 'Pendanaan',
                'description' => 'Penyaluran Dana',
                'status' => '0',
                'akun' => $rekeningSimpanan->id,
                // 'akun' => '2',
                'anggota_id' => $rekeningPendanaan->anggota->id,
                'jenis_transaksi' => '4',
                'nominal' => $amountPokokSimpanan->formatByDecimal(),
                // 'margin' => $amountInterest->formatByDecimal(),
                'created_by' => 1,
                'updated_by' => 1,
            ]);
            $entry = $rekeningSimpanan->credit(null, $amountPokokSimpanan->formatByDecimal(), config('money.defaultCurrency'), 'Penyaluran dana ke simpanan', $ledgerSimp->id);
            $entry->save();
            

            DB::commit();

            return redirect()
                ->route('rekening-pendanaan.index')
                ->with('message', 'Transaksi berhasil');

        } catch (\Exception $ex) {
            Log::debug($ex);

            DB::rollback();

            return redirect()
                ->route('rekening-pendanaan.index')
                ->with('error', 'Transaksi gagal: ' . $ex->getMessage());
        }




    }

    /**
     * Handle the RekeningPendanaan "updated" event.
     *
     * @param  \App\Models\RekeningPendanaan  $rekeningPendanaan
     * @return void
     */
    public function updated(RekeningPendanaan $rekeningPendanaan)
    {
        //
    }

    /**
     * Handle the RekeningPendanaan "deleted" event.
     *
     * @param  \App\Models\RekeningPendanaan  $rekeningPendanaan
     * @return void
     */
    public function deleted(RekeningPendanaan $rekeningPendanaan)
    {
        //
    }

    /**
     * Handle the RekeningPendanaan "restored" event.
     *
     * @param  \App\Models\RekeningPendanaan  $rekeningPendanaan
     * @return void
     */
    public function restored(RekeningPendanaan $rekeningPendanaan)
    {
        //
    }

    /**
     * Handle the RekeningPendanaan "force deleted" event.
     *
     * @param  \App\Models\RekeningPendanaan  $rekeningPendanaan
     * @return void
     */
    public function forceDeleted(RekeningPendanaan $rekeningPendanaan)
    {
        //
    }
}
