<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNikInKodeProfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kode_profils', function (Blueprint $table) {
            $table->string('nik')->after('nama_pegawai')->nullable();
            $table->string('alamat')->after('no_hp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kode_profils', function (Blueprint $table) {
            //
        });
    }
}
