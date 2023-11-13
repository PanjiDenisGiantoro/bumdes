<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarInventorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_inventoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gudang')->nullable();
            $table->string('total_produk')->nullable();
            $table->string('total_nilai_produk')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('kategori')->nullable();
            $table->string('satuan_dasar')->nullable();
            $table->string('stok_akhir')->nullable();
            $table->string('harga_beli')->nullable();
            $table->string('akun_pembelian')->nullable();
            $table->string('harga_jual')->nullable();
            $table->string('akun_penjualan')->nullable();
            $table->string('akun_inventori')->nullable();
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
        Schema::dropIfExists('daftar_inventoris');
    }
}
