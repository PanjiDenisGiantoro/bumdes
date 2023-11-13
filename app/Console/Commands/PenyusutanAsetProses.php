<?php

namespace App\Console\Commands;

use App\Models\AkunPerkiraan;
use App\Models\Aset;
use App\Models\DaftarAset;
use App\Models\Ledger;
use Cknow\Money\Money;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenyusutanAsetProses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'penyusutan:aset';

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
        $assets = DB::table('asets')->where('disusutkan', 1)
            ->whereRaw('DAY(STR_TO_DATE(tanggal_akuisisi, "%Y-%m-%d")) = DAY(NOW())')
            ->whereRaw('MONTH(STR_TO_DATE(tanggal_akuisisi, "%Y-%m-%d")) = MONTH(NOW())')
            ->whereRaw('STR_TO_DATE(akhir_masa_manfaat, "%Y-%m-%d") <= "' . now() . '"')
            ->where('tanggal_jual', '=', '0')
            ->get();
        foreach ($assets as $asset) {
            $akun_produk = AkunPerkiraan::findOrFail($asset->akun_beban_penyusutan);
            $jenis_transaksi = AkunPerkiraan::findOrFail($asset->akun_akumulasi_penyusutan);
            $nominal = $asset->penyusutan_bulanan;

            DB::beginTransaction();

            try {
//                $nominal = Money::parse(config('money.defaultCurrency') . $asset->penyusutan_bulanan);

                $ledger = Ledger::create([
                    'type'               => 'DA',
                    'teller_transaction' => 1,
                    'date' => now(),
                    'description'        => 'Penyusutan Asset Management',
                    'reference'        => 'Penyusutan aset - unit - '. $asset->jumlah_aset, $asset->nomor_aset, $asset->nama_aset,
                    'nominal'           => $nominal,
                ]);
                $entry = \App\Facades\Ledger::credit($jenis_transaksi, $akun_produk, $nominal, config('money.defaultCurrency'), $ledger->description, $ledger->id);
                $entry->ledger_id = $ledger->id;
                $entry->save();

                $entry = \App\Facades\Ledger::debit($akun_produk, $jenis_transaksi, $nominal, config('money.defaultCurrency'), $ledger->description, $ledger->id);
                $entry->ledger_id = $ledger->id;
                // $entry->no_rek = $rekening->no_akun;
                $entry->save();

                DB::commit();

                $this->info('Penyusutan aset - unit - '. $asset->jumlah_aset, $asset->nomor_aset, $asset->nama_aset);
            } catch (\Exception $ex) {
                $this->error($ex->getMessage());
                Log::debug($ex);

                DB::rollback();
            }
        }
        return 0;
    }
}
