<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasir', function (Blueprint $table) {
            $table->id();
            $table->boolean('status_anggota');
            $table->bigInteger('anggota_id')->nullable();
            $table->bigInteger('rekening_id')->nullable();
            $table->bigInteger('ledger_id')->nullable();
            $table->date('tanggal');
            $table->json('items');
            $table->boolean('jenis_pembayaran');
            $table->decimal('diskon', 12, 2)->nullable();
            $table->decimal('total', 12, 2);
            $table->decimal('pembayaran', 12, 2);
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
        Schema::dropIfExists('kasir');
    }
}
