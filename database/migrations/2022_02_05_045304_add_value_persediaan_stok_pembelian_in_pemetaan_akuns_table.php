<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuePersediaanStokPembelianInPemetaanAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemetaan_akuns', function (Blueprint $table) {
            $table->string('persediaan_penyesuaian_stok_pembelian')->nullable()->after('GL_persediaan_penyesuaian_stok');
            $table->string('GL_persediaan_penyesuaian_stok_pembelian')->nullable()->after('persediaan_penyesuaian_stok_pembelian');
            $table->string('pembayaran_pembelian_cash')->nullable()->after('GL_persediaan_penyesuaian_stok_pembelian');
            $table->string('GL_pembayaran_pembelian_cash')->nullable()->after('pembayaran_pembelian_cash');
            $table->string('pembayaran_pembelian_transfer')->nullable()->after('GL_pembayaran_pembelian_cash');
            $table->string('GL_pembayaran_pembelian_transfer')->nullable()->after('pembayaran_pembelian_transfer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemetaan_akuns', function (Blueprint $table) {
            //
        });
    }
}
