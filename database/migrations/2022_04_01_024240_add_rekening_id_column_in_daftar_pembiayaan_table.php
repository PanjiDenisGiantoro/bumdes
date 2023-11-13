<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRekeningIdColumnInDaftarPembiayaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_pembiayaans', function (Blueprint $table) {
            $table->string('rekening_pendanaan_id')->after('status')->nullable();
            $table->string('rekening_simpanan_dana_id')->after('rekening_pendanaan_id')->nullable();
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
