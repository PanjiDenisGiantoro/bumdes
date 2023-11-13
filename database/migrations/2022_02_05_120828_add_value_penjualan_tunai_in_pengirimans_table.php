<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuePenjualanTunaiInPengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->string('tunai')->after('status_pembayaran_penjualan');
            $table->string('id_bank')->after('tunai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            //
        });
    }
}
