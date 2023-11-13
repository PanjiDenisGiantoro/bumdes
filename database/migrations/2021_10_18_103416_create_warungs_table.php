<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('email_pemohon')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->smallInteger('status_perkawinan')->nullable();
            $table->string('alamat');
            $table->char('kode_pos', 5);
            $table->string('kota');
            $table->string('provinsi');
            $table->string('no_handphone')->nullable();
            $table->string('no_telpon')->nullable();
            $table->string('nama_warung');
            $table->string('profil_warung')->nullable();
            $table->smallInteger('bidang_usaha')->nullable();
            $table->string('berdiri_sejak')->nullable();
            $table->smallInteger('status_bangunan')->nullable();
            $table->point('koordinat_warung')->nullable();
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
        Schema::dropIfExists('warungs');
    }
}
