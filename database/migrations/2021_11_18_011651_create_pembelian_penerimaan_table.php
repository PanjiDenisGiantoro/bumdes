<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_penerimaan', function (Blueprint $table) {
            $table->id();
            $table->integer('pesananpembelian_id');
            $table->integer('pesananpembelianbody_id');
            $table->date('tanggal_penerimaan');
            $table->string('no_invoice');
            $table->string('status', 30);
            $table->string('no_surat_jalan');
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
        Schema::dropIfExists('pembelian_penerimaan');
    }
}
