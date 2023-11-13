<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInPemesananPenjualanBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan_penjualan_bodies', function (Blueprint $table) {
            $table->string('harga_produk')->default(0)->after('termin');
            $table->string('total_amount')->default(0)->after('harga_produk');
            $table->string('pajak_type')->default(0)->after('total_amount');
            $table->string('total_ppn')->default(0)->after('pajak_type');
            $table->string('total_pph')->default(0)->after('total_ppn');
            $table->string('total_diskon')->default(0)->after('total_pph');
            $table->string('total_amount_all')->default(0)->after('total_diskon');
            $table->string('pajak')->default(0)->after('total_amount_all');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan_penjualan_bodies', function (Blueprint $table) {
            //
        });
    }
}
