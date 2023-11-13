<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananPenjualanBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_penjualan_bodies', function (Blueprint $table) {
            $table->id();
            $table->string('id_pemesanan')->nullable();
            $table->string('id_produk')->nullable();
            $table->string('qty')->nullable();
            $table->string('diskon')->nullable();
            $table->string('termin')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('pemesanan_penjualan_bodies');
    }
}
