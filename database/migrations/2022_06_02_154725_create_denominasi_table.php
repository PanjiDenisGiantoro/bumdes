<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenominasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denominasi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_transaksi');
            $table->string('jenis_operasi');
            $table->string('teller_id');
            $table->string('total_amount');
            $table->text('keterangan');
            $table->integer('lejer');
            $table->integer('unit_100');
            $table->integer('unit_200');
            $table->integer('unit_500');
            $table->integer('unit_1000');
            $table->integer('unit_1000_coin');
            $table->integer('unit_2000');
            $table->integer('unit_5000');
            $table->integer('unit_10000');
            $table->integer('unit_20000');
            $table->integer('unit_50000');
            $table->integer('unit_75000');
            $table->integer('unit_100000');
            $table->integer('value_100');
            $table->integer('value_200');
            $table->integer('value_500');
            $table->integer('value_1000');
            $table->integer('value_1000_coin');
            $table->integer('value_2000');
            $table->integer('value_5000');
            $table->integer('value_10000');
            $table->integer('value_20000');
            $table->integer('value_50000');
            $table->integer('value_75000');
            $table->integer('value_100000');
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('denominasi');
    }
}
