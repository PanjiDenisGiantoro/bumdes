<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueProdukInPembelianPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian_pembayaran', function (Blueprint $table) {
            $table->string('stok_bertambah')->nullable()->after('catatan');
            $table->string('produk_id')->nullable()->after('stok_bertambah');
            $table->string('qty')->nullable()->after('produk_id');
            $table->string('stok_berkurang')->nullable()->after('qty');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembelian_pembayaran', function (Blueprint $table) {
            //
        });
    }
}
