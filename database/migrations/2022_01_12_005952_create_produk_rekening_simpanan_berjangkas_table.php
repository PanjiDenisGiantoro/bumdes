<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukRekeningSimpananBerjangkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_rekening_simpanan_berjangkas', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_produk_berjangka')->nullable();
            $table->string('akad_simpanan_berjangka')->nullable();
            $table->string('kode_simpanan_berjangka')->nullable();
            $table->string('nama_simpanan_berjangka')->nullable();
            $table->string('deskripsi_simpanan_berjangka')->nullable();
            $table->decimal('storan', 13, 2)->nullable();
            $table->integer('jangka_waktu')->nullable();
            $table->decimal('biaya_admin_berjangka', 13, 2)->nullable();
            $table->decimal('biaya_materai_berjangka', 13, 2)->nullable();
            $table->decimal('biaya_registrasi_berjangka', 13, 2)->nullable();
            $table->decimal('biaya_asuransi_berjangka', 13, 2)->nullable();
            $table->decimal('biaya_penutupan_rekening_berjangka', 13, 2)->nullable();
            $table->string('GL_biaya_admin')->nullable();
            $table->string('GL_biaya_materai')->nullable();
            $table->string('GL_biaya_registrasi')->nullable();
            $table->string('GL_biaya_asuransi')->nullable();
            $table->string('GL_biaya_penutupan_rekening')->nullable();
            $table->string('GL_produk_simpanan')->nullable();
            $table->string('GL_beban_bagi_hasil')->nullable();
            $table->string('GL_penampungan_sementara')->nullable();
            $table->string('nisbah_koperasi')->nullable();
            $table->string('nisbah_anggota')->nullable();
            $table->smallInteger('status')->nullable();
            $table->smallInteger('boleh_transfer')->nullable();
            $table->smallInteger('bagi_hasil')->nullable();
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
        Schema::dropIfExists('produk_rekening_simpanan_berjangkas');
    }
}
