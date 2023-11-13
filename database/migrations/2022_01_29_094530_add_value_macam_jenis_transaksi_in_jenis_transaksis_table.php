<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueMacamJenisTransaksiInJenisTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_transaksis', function (Blueprint $table) {
            $table->string('macam_transaksi')->nullable()->after('jenis_transaksi');
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
