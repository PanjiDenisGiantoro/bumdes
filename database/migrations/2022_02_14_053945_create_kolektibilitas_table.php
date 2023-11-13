<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKolektibilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kolektibilitas', function (Blueprint $table) {
            $table->id();
            $table->string('status_kolek')->nullable();
            $table->string('dari_tunggakan')->nullable();
            $table->string('sampai_tunggakan')->nullable();
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
        Schema::dropIfExists('kolektibilitas');
    }
}
