<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemetaanAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemetaan_akuns', function (Blueprint $table) {
            $table->id();
            $table->integer('pendapatan_penjualan')->nullable();
            $table->integer('pembelian')->nullable();
            $table->integer('persediaan_produk')->nullable();
            $table->integer('diskon_penjualan')->nullable();
            $table->integer('retur_penjualan')->nullable();
            $table->integer('pengiriman_penjualan')->nullable();
            $table->integer('pembayaran_dimuka')->nullable();
            $table->integer('penjualan_belum_ditagih')->nullable();
            $table->integer('piutang_belum_ditagih')->nullable();
            $table->integer('pengiriman_pembelian')->nullable();
            $table->integer('uang_muka_pembelian')->nullable();
            $table->integer('hutang_belum_ditagih')->nullable();
            $table->integer('piutang_usaha')->nullable();
            $table->integer('hutang_usaha')->nullable();
            $table->integer('ekuitas_saldo_awal')->nullable();
            $table->integer('aset_Tetap')->nullable();
            $table->integer('persediaan_penyesuaian_stok')->nullable();
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
        Schema::dropIfExists('pemetaan_akun');
    }
}
