<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukRekeningSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_rekening_simpanans', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_produk')->nullable();
            $table->string('akad_simpanan')->nullable();
            $table->string('kode_simpanan')->nullable();
            $table->string('nama_simpanan')->nullable();
            $table->string('deskripsi_simpanan')->nullable();
            $table->decimal('storan_minimal', 13, 2)->nullable();
            $table->decimal('storan_selanjut', 13, 2)->nullable();
            $table->decimal('saldo_mengendap', 13, 2)->nullable();
            $table->decimal('penalti', 13, 2)->nullable();
            $table->integer('jangka_waktu')->nullable();
            $table->decimal('biaya_admin', 13, 2)->nullable();
            $table->decimal('biaya_materai', 13, 2)->nullable();
            $table->decimal('biaya_registrasi', 13, 2)->nullable();
            $table->decimal('biaya_asuransi', 13, 2)->nullable();
            $table->decimal('biaya_penutupan_rekening', 13, 2)->nullable();
            $table->decimal('biaya_transfer_luar', 13, 2)->nullable();
            $table->double('pph_basil')->nullable();
            $table->double('zakat_basil')->nullable();
            $table->smallInteger('status')->nullable();
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
        Schema::dropIfExists('produk_rekening_simpanans');
    }
}
