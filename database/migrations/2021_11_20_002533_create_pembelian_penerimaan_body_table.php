<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianPenerimaanBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_penerimaan_body', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->integer('pembelian_penerimaan_id');
            $table->integer('kuantitas');
            $table->integer('pajak');
            $table->integer('diskon');
            $table->integer('total');
            $table->integer('subtotal');
            $table->integer('diskon_seluruh');
            $table->integer('total_seluruh');
            $table->integer('pajak_seluruh');
            $table->integer('total_tertagih');
            $table->integer('diskon_seluruhpersen');
            $table->integer('type_diskon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_penerimaan_body');
    }
}
