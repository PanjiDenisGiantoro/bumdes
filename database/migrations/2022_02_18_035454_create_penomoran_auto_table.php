<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenomoranAutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penomoran_auto', function (Blueprint $table) {
            $table->id();
            $table->string('head')->nullable();
            $table->string('format_depan')->nullable();
            $table->string('format_tengah')->nullable();
            $table->string('format_belakang')->nullable();
            $table->string('no_urut')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('penomoran_auto');
    }
}
