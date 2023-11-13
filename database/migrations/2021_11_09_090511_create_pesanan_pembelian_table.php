<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pesanan');
            $table->string('no_pesanan');
            $table->integer('supplier_id');
            $table->integer('termin_id');
            $table->integer('ekpedisi_id');
            $table->integer('produk_id');
            $table->string('status')->default('Baru');
            $table->integer('total');
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
        Schema::dropIfExists('pesanan_pembelian');
    }
}
