<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAnggotaInDaftarPembiayaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_pembiayaans', function (Blueprint $table) {
            //
            $table->string('nama_anggota')->nullable()->change();
            $table->string('plafon')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_pembiayaans', function (Blueprint $table) {
            //
        });
    }
}
