<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSubtotalDiskonInPesananPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanan_pembelian', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('total_seluruh');
            $table->dropColumn('subtotal');
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
