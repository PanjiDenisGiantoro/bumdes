<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateNotifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_notifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_notifikasi')->nullable();
            $table->string('template_notifikasi')->nullable();
            $table->string('keterangan_notifikasi')->nullable();

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
        Schema::dropIfExists('template_notifikasis');
    }
}
