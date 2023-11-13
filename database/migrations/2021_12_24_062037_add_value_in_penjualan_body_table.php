<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueInPenjualanBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan_bodies', function (Blueprint $table) {
            $table->string('harga_produk')->default(0)->after('id_terminproduk');
            $table->string('total_subtotal')->default(0)->after('harga_produk');
            $table->string('total_amount')->default(0)->after('total_subtotal');
            $table->string('pajak_type')->default(0)->after('total_amount');
            $table->string('total_ppn')->default(0)->after('pajak_type');
            $table->string('total_pph')->default(0)->after('total_ppn');
            $table->string('total_diskon')->default(0)->after('total_pph');
            $table->string('total_amount_all')->default(0)->after('total_diskon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualan_body', function (Blueprint $table) {
            //
        });
    }
}
