<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZpengajuanInZpengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zpengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('desa')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('ibu_kandung')->nullable();
            $table->string('selfi')->nullable();
            $table->string('ktp')->nullable();
            $table->integer('margin')->nullable();
            $table->integer('pendapatan')->nullable();
            $table->integer('pengeluaran')->nullable();
            $table->integer('plafon')->nullable();
            $table->string('ringkasan')->nullable();
            $table->integer('total_pengeluaran')->nullable();
            $table->integer('sisa_dana')->nullable();
            $table->integer('rasio')->nullable();
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
        Schema::dropIfExists('zpengajuan_in_zpengajuan');
    }
}
