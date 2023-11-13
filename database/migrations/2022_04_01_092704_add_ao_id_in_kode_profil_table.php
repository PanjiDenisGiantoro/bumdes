<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAoIdInKodeProfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kode_profils', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->nullable();
            $table->string('anggota_id')->after('cabang_unit')->nullable();
            $table->string('ao_id')->after('anggota_id')->nullable();
            $table->integer('penampung_id')->after('id_jabatan')->nullable();
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
