<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePajakSeluruhInPesananPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanan_pembelian', function (Blueprint $table) {
            $table->dropColumn('pajak');
            $table->dropColumn('diskon');
            $table->dropColumn('total_tertagih');
            $table->dropColumn('pajak_seluruh');
            $table->dropColumn('diskon_seluruh');
            $table->dropColumn('kuantitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanan_pembelian', function (Blueprint $table) {
            //
        });
    }
}
