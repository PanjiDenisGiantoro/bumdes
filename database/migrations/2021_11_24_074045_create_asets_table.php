<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aset')->nullable();
            $table->string('nomor_aset')->nullable();
            $table->string('tanggal_akuisisi')->nullable();
            $table->string('biaya_akuisisi')->nullable();
            $table->string('akun_aset_tetap')->nullable();
            $table->string('akun_kredit')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('disusutkan')->nullable();
            $table->string('akun_beban_penyusutan')->nullable();
            $table->string('akun_akumulasi_penyusutan')->nullable();
            $table->string('masa_manfaat')->nullable();
            $table->string('saldo_awal_akumulasi')->nullable();
            $table->string('nilai')->nullable();
            $table->string('tanggal_mula_penyusutan')->nullable();
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
        Schema::dropIfExists('asets');
    }
}
