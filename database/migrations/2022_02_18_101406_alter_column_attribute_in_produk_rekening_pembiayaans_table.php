<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnAttributeInProdukRekeningPembiayaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_rekening_pembiayaans', function (Blueprint $table) {
            $table->decimal('minimal_pembiayaan', 13, 2)->change();
            $table->decimal('maksimal_pembiayaan', 13, 2)->change();
            $table->decimal('nisbah', 13, 2)->change();
            $table->decimal('denda_keterlambatan', 13, 2)->change();
            $table->decimal('biaya_admin', 13, 2)->change();
            $table->decimal('biaya_materai', 13, 2)->change();
            $table->decimal('biaya_asuransi', 13, 2)->change();
            $table->decimal('biaya_lain_lain', 13, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_rekening_pembiayaans', function (Blueprint $table) {
            //
        });
    }
}
