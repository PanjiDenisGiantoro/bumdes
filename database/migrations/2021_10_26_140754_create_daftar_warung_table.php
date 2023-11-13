<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarWarungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('daftar_warungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->date('tanggal')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_mitra')->nullable();
            $table->string('nama_warung')->nullable();
            $table->string('profil_warung')->nullable();
            $table->string('bidang_usaha')->nullable();
            $table->date('berdiri_sejak')->nullable();
            // $table->smallInteger('status_perkawinan')->nullable();
            $table->string('status_bangunan');
            // $table->char('kode_pos', 5);
            $table->string('map');
            // $table->string('provinsi');
            // $table->string('no_handphone')->nullable();
            // $table->string('no_telpon')->nullable();
            // $table->string('nama_warung');
            // $table->string('profil_warung')->nullable();
            // $table->smallInteger('bidang_usaha')->nullable();
            // $table->string('berdiri_sejak')->nullable();
            // $table->smallInteger('status_bangunan')->nullable();
            // $table->point('koordinat_warung')->nullable();
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
        Schema::dropIfExists('daftar_warung');
    }
}
