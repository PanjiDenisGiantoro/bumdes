<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelepasanAsetMgtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelepasan_aset_mgts', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelompok_aset')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->string('dijual')->nullable();
            $table->string('harga_jual')->nullable();
            $table->string('akun_deposit_penjualan')->nullable();
            $table->string('akun_kerugian_penjualan')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pelepasan_aset_mgts');
    }
}
