<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnKuantitasInPesananPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanan_pembelian', function (Blueprint $table) {
            $table->integer('kuantitas')->after('status');
            $table->integer('subtotal')->after('status');
            $table->integer('diskon_seluruh')->after('status');
            $table->integer('total_seluruh')->after('status');
            $table->integer('pajak_seluruh')->after('status');
            $table->integer('total_tertagih')->after('status');
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
