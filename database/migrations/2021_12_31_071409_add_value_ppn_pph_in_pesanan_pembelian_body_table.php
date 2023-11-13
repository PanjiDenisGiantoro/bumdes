<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuePpnPphInPesananPembelianBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanan_pembelian_body', function (Blueprint $table) {
            $table->renameColumn('pajak_seluruh', 'ppn')->default(0);
            $table->integer('pph')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanan_pembelian_body', function (Blueprint $table) {
            //
        });
    }
}
