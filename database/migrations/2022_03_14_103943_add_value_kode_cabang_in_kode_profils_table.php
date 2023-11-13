<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueKodeCabangInKodeProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kode_perusahaans', function (Blueprint $table) {
            $table->string('kode_cabang')->nullable()->after('npwp');
            $table->string('kode_perusahaan')->nullable()->after('kode_cabang');
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
