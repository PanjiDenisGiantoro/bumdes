<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('penerimaan_id');
            $table->date('tanggal_pembayaran');
            $table->integer('jumlah_tagihan');
            $table->integer('jumlah_bayar');
            $table->integer('sisa_tagihan');
            $table->string('akun_pembayaran');
            $table->text('catatan');
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
        Schema::dropIfExists('pembelian_pembayaran');
    }
}
