<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAkunIdAndCreditToJenisTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_transaksis', function (Blueprint $table) {
            $table->bigInteger('akun_id')->after('id');
            $table->boolean('kredit')->default(0)->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_transaksis', function (Blueprint $table) {
            //
        });
    }
}
