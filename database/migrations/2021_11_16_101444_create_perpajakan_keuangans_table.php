<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerpajakanKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perpajakan_keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pajak')->nullable();
            $table->string('tarif_persentase')->nullable();
            $table->string('pemotongan')->nullable();
            $table->string('akun_pajak_penjualan')->nullable();
            $table->string('akun_pajak_pembelian')->nullable();
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
        Schema::dropIfExists('perpajakan_keuangans');
    }
}
