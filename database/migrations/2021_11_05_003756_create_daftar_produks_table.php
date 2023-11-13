<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk')->nullable();
            $table->string('kode_produk')->nullable();
            $table->integer('id_kategori_produk')->nullable();
            $table->string('kode_sku')->nullable();
            $table->string('berat_satuan')->nullable();
            $table->string('id_satuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('id_gudang')->nullable();
            $table->string('no_barcode')->nullable();
            $table->string('harga_beli')->nullable();
            $table->string('pajak_pembelian')->nullable();
            $table->string('akun_pembelian')->nullable();
            $table->string('akun_penjualan')->nullable();
            $table->string('harga_jual')->nullable();

            $table->string('pajak_penjualan')->nullable();
            $table->string('harga_anggota')->nullable();
            $table->string('harga_bukan_anggota')->nullable();
            $table->string('inventory')->nullable();
            $table->string('akun_tersedia')->nullable();
            $table->string('stok')->nullable();

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
        Schema::dropIfExists('daftar_produks');
    }
}
