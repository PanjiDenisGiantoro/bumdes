<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameAnggotaInDaftarPembiayaansTable extends Migration
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
            $table->renameColumn('nama_anggota', 'id_anggota');

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
