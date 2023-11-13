<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueInKodeProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kode_profils', function (Blueprint $table) {
            $table->integer('status')->after('hak_akses')->nullable();
            $table->string('limit_transaksi')->after('hak_akses')->nullable();
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
