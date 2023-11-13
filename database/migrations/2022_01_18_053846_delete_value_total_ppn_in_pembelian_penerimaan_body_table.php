<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteValueTotalPpnInPembelianPenerimaanBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian_penerimaan_body', function (Blueprint $table) {
            $table->dropColumn('total_pajak');
            $table->dropColumn('total_pajak_pph');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembelian_penerimaan_body', function (Blueprint $table) {
            //
        });
    }
}
