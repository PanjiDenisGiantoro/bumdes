<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueStatusInPemetaanAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemetaan_akuns', function (Blueprint $table) {
            $table->integer('pembayaran_penjualan_cash')->nullable()->after('persediaan_penyesuaian_stok');
            $table->integer('pembayaran_penjualan_sebagian')->nullable()->after('pembayaran_penjualan_cash');
            $table->integer('pembayaran_penjualan_transfer')->nullable()->after('pembayaran_penjualan_sebagian');
            $table->string('GL_pendapatan_penjualan')->nullable()->after('pendapatan_penjualan');
            $table->string('GL_pembelian')->nullable()->after('pembelian');
            $table->string('GL_persediaan_produk')->nullable()->after('persediaan_produk');
            $table->string('GL_diskon_penjualan')->nullable()->after('diskon_penjualan');
            $table->string('GL_retur_penjualan')->nullable()->after('retur_penjualan');
            $table->string('GL_pengiriman_penjualan')->nullable()->after('pengiriman_penjualan');
            $table->string('GL_pembayaran_dimuka')->nullable()->after('pembayaran_dimuka');
            $table->string('GL_penjualan_belum_ditagih')->nullable()->after('penjualan_belum_ditagih');
            $table->string('GL_piutang_belum_ditagih')->nullable()->after('piutang_belum_ditagih');
            $table->string('GL_pengiriman_pembelian')->nullable()->after('pengiriman_pembelian');
            $table->string('GL_uang_muka_pembelian')->nullable()->after('uang_muka_pembelian');
            $table->string('GL_hutang_belum_ditagih')->nullable()->after('hutang_belum_ditagih');
            $table->string('GL_piutang_usaha')->nullable()->after('piutang_usaha');
            $table->string('GL_hutang_usaha')->nullable()->after('hutang_usaha');
            $table->string('GL_ekuitas_saldo_awal')->nullable()->after('ekuitas_saldo_awal');
            $table->string('GL_aset_Tetap')->nullable()->after('aset_Tetap');
            $table->string('GL_persediaan_penyesuaian_stok')->nullable()->after('persediaan_penyesuaian_stok');
            $table->string('GL_pembayaran_penjualan_cash')->nullable()->after('pembayaran_penjualan_cash');
            $table->string('GL_pembayaran_penjualan_sebagian')->nullable()->after('pembayaran_penjualan_sebagian');
            $table->string('GL_pembayaran_penjualan_transfer')->nullable()->after('pembayaran_penjualan_transfer');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemetaan_akun', function (Blueprint $table) {
            //
        });
    }
}
