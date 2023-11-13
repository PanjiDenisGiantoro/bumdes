<?php

namespace App\Console\Commands;

use App\Models\AkunPerkiraan;
use App\Models\Ledger;
use App\Models\RekeningSimjaka;
use App\Models\RekeningSimpanan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AroProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aro:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $simjaka = RekeningSimjaka::withoutGlobalScope('simjaka_by_cabang')
            ->whereDate('tanggal_jatuh_tempo', now())
            ->get();

        $simjaka->each(function ($item) {

            if ($item->aro == 1) {
                // ARO True: Lanjut tempoh berjangka, tanggal aktif dimulai baru dan jatuh tempo berikutnya disesuaikan
                
                $tanggalAktifBaru = now()->format('Y-m-d');
                $tanggalJatuhTempoBaru = now()->addMonths($item->jangka_waktu);

                $item->tanggal_aktif = $tanggalAktifBaru;
                $item->tanggal_jatuh_tempo = $tanggalJatuhTempoBaru->format('Y-m-d');
                $item->save();
                
            } else if ($item->aro == 0) {
                // ARO False: cair semua uang ke rekening basil
                // TODO: apa terjadi pada akun ini setelah uang dicairkan?

                if ($item->saldo > 0) {

                    $rekeningTransferBasil = RekeningSimpanan::where('id', $item->rek_transfer_basil)->first();
                    $GLRekeningBasil = AkunPerkiraan::where('id', $rekeningTransferBasil->produk->GL_produk_simpanan)->first();
                    $GLRekeningSimjaka = AkunPerkiraan::where('id', $item->produk->GL_produk_simpanan)->first();
    
                    $description = "Pencairan Saldo Rekening Simjaka " . $item->no_akun  . " - " . $item->anggota->nama_pemohon . " kepada " . 
                        $rekeningTransferBasil->no_akun ?? '' . " - " . $rekeningTransferBasil->anggota->nama_pemohon;
    
                    $ledger = Ledger::create([
                        'type' => 'TN',
                        'date' => now()->format('Y-m-d'),
                        'journal_no' => '123',
                        // 'reference' => '',
                        'description' => $description,
                        'jenis_transaksi' => '99',
                        'nominal' => $item->saldo,
                        'margin' => '0.00',
                    ]);
    
                    if ($rekeningTransferBasil) {
                        DB::beginTransaction();
    
                        try {
                            // D source
                            $entry = \App\Facades\Ledger::debit($GLRekeningSimjaka, $GLRekeningBasil, $item->saldo, config('money.defaultCurrency'), $description, $ledger->id);
                            $entry->save();
    
                            // C loc
                            $entry = \App\Facades\Ledger::credit($GLRekeningBasil, $rekeningTransferBasil, $item->saldo, config('money.defaultCurrency'), $description, $ledger->id);
                            $entry->save();
    
                            $entry = $rekeningTransferBasil->credit(null, $item->saldo, config('money.defaultCurrency'), $description, $ledger->id);
                            $entry->save();
                            
                            $entry = $item->debit(null, $item->saldo, config('money.defaultCurrency'), $description, $ledger->id);
                            $entry->save();

                            DB::commit();
    
                        } catch (\Exception $ex) {
                            Log::debug($ex);
                            // $this->info($ex->getMessage());
                            DB::rollback();
                        }
                    }
                }

                
                
            }
            
        });


        return 0;
    }
}
