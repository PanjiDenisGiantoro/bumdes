<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_bodies', function (Blueprint $table) {
            $table->id();
            $table->string('id_penjualan')->nullable();
            $table->string('qty')->nullable();
            $table->string('diskonproduk')->nullable();
            $table->string('pajak')->nullable();
            $table->string('id_terminproduk')->nullable();
            $table->string('totalproduk')->nullable();

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
        Schema::dropIfExists('penjualan_body');
    }
}
