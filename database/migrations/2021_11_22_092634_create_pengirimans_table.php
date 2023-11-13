<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();

            $table->string('status')->nullable();
            $table->string('ada_pemesanan')->nullable();
            $table->string('no_pemesanan')->nullable();
            $table->string('pelanggan')->nullable();
            $table->string('id_pelanggan')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('tanggal_pengiriman')->nullable();
            $table->string('no_pengiriman')->nullable();
            $table->string('termin_pengiriman')->nullable();
            $table->string('reference')->nullable();
            $table->string('pajaktotal')->nullable();
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
        Schema::dropIfExists('pengirimans');
    }
}
