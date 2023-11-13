<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarPembiayaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('daftar_pembiayaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->string('nik')->nullable();
            $table->string('no_mitra')->nullable();
            $table->string('batch')->nullable();
            $table->date('tanggal_permohonan')->nullable();
            $table->string('plafon');
            $table->string('bulan')->nullable();
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
        Schema::dropIfExists('daftar_pembiayaans');
    }
}
