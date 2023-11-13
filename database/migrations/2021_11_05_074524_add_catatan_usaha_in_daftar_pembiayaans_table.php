<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatatanUsahaInDaftarPembiayaansTable extends Migration
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
            $table->integer('lama_usaha')->nullable()->after('bulan');
            $table->string('pengelola')->nullable()->after('lama_usaha');
            $table->string('usaha')->nullable()->after('pengelola');
            $table->string('lingkungan')->nullable()->after('usaha');
            $table->string('omset_harian')->nullable()->after('lingkungan');
            $table->string('pengeluaran')->nullable()->after('omset_harian');
            $table->string('catatan')->nullable()->after('pengeluaran');

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
