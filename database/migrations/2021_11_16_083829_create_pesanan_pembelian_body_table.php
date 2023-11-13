<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananPembelianBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_pembelian_body', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->integer('pesanan_pembelian_id');
            $table->integer('kuantitas');
            $table->integer('pajak');
            $table->integer('diskon');
            $table->integer('total');
            $table->integer('subtotal');
            $table->integer('diskon_seluruh');
            $table->integer('total_seluruh');
            $table->integer('pajak_seluruh');
            $table->integer('total_tertagih');
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
        Schema::dropIfExists('pesanan_pembelian_body');
    }
}
