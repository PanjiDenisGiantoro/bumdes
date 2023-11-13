<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueBiayaPengirimanInPembelianPenerimaanBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian_penerimaan_body', function (Blueprint $table) {
            $table->integer('harga_produk');
            $table->integer('total_pajak');
            $table->integer('total_pajak_pph');
            $table->integer('total_ppn');
            $table->integer('total_pph');
            $table->integer('total_amount');
            $table->integer('total_amount_all');
            $table->renameColumn('total_seluruh', 'diskongrand');
            $table->integer('total_sub');
            $table->integer('total_disk');
            $table->integer('diskon_per_item');
            $table->integer('diskon_calculate');
            $table->integer('biaya_pengiriman');
            $table->renameColumn('pajak_seluruh','ppn');
            $table->integer('pph');
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
