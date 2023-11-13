<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_officers', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->nullable();
            $table->string('user_id')->nullable();
            $table->string('jenis_ao')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('penampungan_type')->nullable();
            $table->string('penampungan_id')->nullable();
            $table->string('status_ao')->nullable();
            $table->string('status_apps')->nullable();
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
        Schema::dropIfExists('akun_officers');
    }
}
