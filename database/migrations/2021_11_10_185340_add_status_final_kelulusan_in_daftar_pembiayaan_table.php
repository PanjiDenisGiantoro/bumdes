<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFinalKelulusanInDaftarPembiayaanTable extends Migration
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
            $table->string('final_status')->default(0)->after('no_rekening');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_pembiayaan', function (Blueprint $table) {
            //
        });
    }
}
