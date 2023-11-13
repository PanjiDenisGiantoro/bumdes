<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueStatusPembayaranPenjualanInPengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->string('status_pembayaran_penjualan')->nullable()->after('sisa_tagihan');
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
