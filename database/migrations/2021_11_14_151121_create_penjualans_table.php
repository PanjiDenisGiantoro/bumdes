<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('anggota')->nullable();
            $table->string('id_pelanggan')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('no_pesanan')->nullable();
            $table->string('id_termin')->nullable();
            $table->string('diskon')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('biaya_pengiriman')->nullable();
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
        Schema::dropIfExists('penjualans');
    }
}
