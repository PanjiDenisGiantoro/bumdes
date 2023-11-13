<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_koperasi');
            $table->string('nama_cabang');
            $table->string('alamat_cabang');
            $table->string('no_telp');
            $table->string('email');
            $table->string('pic');
            $table->string('tanggal_operasi');
            $table->string('tanggal_daftar');
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
        Schema::dropIfExists('cabangs');
    }
}
