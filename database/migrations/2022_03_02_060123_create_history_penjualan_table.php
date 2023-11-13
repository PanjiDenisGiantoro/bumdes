<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengiriman')->nullable();
            $table->string('non_anggota')->nullable();
            $table->string('total')->nullable();
            $table->string('bayar')->nullable();
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
        Schema::dropIfExists('history_penjualan');
    }
}
