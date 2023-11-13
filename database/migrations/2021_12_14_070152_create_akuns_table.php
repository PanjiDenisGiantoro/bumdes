<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akuns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_kelompok_id');
            $table->string('kode');
            $table->string('nama');
            $table->text('keterangan')->nullable();
            $table->decimal('starting_balance', 12, 2)->default(0)->nullable();
            $table->smallInteger('arus_kas_aktifitas')->nullable();
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
        Schema::dropIfExists('akuns');
    }
}
