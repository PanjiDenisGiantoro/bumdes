<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon')->nullable();
            $table->string('no_mitra')->nullable();
            $table->string('email')->nullable();
            $table->integer('nik')->nullable();
            $table->integer('no_kk')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin',['Pria','Wanita'])->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('no_rumah')->nullable();
            $table->string('nama_jalan')->nullable();
            $table->string('rtrw')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('bumdes')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_telpon')->nullable();
            $table->string('status_keluarga')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('namasehubungkeluarga')->nullable();
            $table->string('no_telp_keluarga')->nullable();
            $table->string('nama_kerabat')->nullable();
            $table->string('file_serfie')->nullable();
            $table->string('file_ktp')->nullable();
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
        Schema::dropIfExists('anggotas');
    }
}
