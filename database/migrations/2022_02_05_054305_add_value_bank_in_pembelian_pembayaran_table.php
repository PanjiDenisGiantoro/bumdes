<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueBankInPembelianPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian_pembayaran', function (Blueprint $table) {
            $table->string('tunai')->after('stok_berkurang');
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
        Schema::table('pembelian_pembayaran', function (Blueprint $table) {
            //
        });
    }
}
