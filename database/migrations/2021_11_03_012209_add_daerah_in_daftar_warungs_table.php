<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDaerahInDaftarWarungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_warungs', function (Blueprint $table) {
            //
            $table->string('nama_jalan')->nullable()->after('status_bangunan');
            $table->string('no_rumah')->nullable()->after('nama_jalan');
            $table->string('rtrw')->nullable()->after('no_rumah');
            $table->string('provinsi')->nullable()->after('rtrw');
            $table->string('kota')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kota');
            $table->string('desa')->nullable()->after('kecamatan');
            $table->string('kodepos')->nullable()->after('desa');


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
