<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianPembayaranBody extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_pembayaran_body', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian_pembayaran')->nullable();
            $table->string('produk')->nullable();
            $table->string('qty')->nullable();
            $table->string('stok')->nullable();
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
        Schema::dropIfExists('pembelian_pembayaran_body');
    }
}
