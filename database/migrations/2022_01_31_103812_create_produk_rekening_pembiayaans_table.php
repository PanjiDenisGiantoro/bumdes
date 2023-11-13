<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukRekeningPembiayaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_rekening_pembiayaans', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_produk')->nullable();
            $table->string('akad_simpanan')->nullable();
            $table->string('kode_simpanan')->nullable();
            $table->string('nama_simpanan')->nullable();
            $table->string('deskripsi_simpanan')->nullable();
            $table->string('storan_minimal')->nullable();
            $table->string('storan_maksimal')->nullable();
            $table->string('nisbah')->nullable();
            $table->string('denda_keterlambatan')->nullable();
            $table->string('biaya_admin')->nullable();
            $table->string('biaya_materai')->nullable();
            $table->string('biaya_asuransi')->nullable();
            $table->string('biaya_lain_lain')->nullable();
            $table->string('GL_biaya_admin')->nullable();
            $table->string('GL_biaya_materai')->nullable();
            $table->string('GL_biaya_asuransi')->nullable();
            $table->string('GL_biaya_lain_lain')->nullable();
            $table->string('GL_produk_pembiayaan')->nullable();
            $table->string('GL_basil')->nullable();
            $table->string('GL_ditangguhkan')->nullable();
            $table->string('GL_infaq_denda')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('produk_rekening_pembiayaans');
    }
}
