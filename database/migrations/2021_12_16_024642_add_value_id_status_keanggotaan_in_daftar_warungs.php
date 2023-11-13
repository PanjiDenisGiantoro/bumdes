<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueIdStatusKeanggotaanInDaftarWarungs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_warungs', function (Blueprint $table) {
            $table->string('id_status_keanggotaan')->default(0)->after('kodepos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_warungs', function (Blueprint $table) {
            //
        });
    }
}
