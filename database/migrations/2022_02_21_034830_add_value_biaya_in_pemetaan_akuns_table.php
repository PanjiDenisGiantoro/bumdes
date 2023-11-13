<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueBiayaInPemetaanAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemetaan_akuns', function (Blueprint $table) {
            $table->string('biaya_tunai')->nullable()->after('GL_pembayaran_penjualan_transfer');
            $table->string('GL_biaya_tunai')->nullable()->after('biaya_tunai');
            $table->string('biaya_non_tunai')->nullable()->after('GL_biaya_tunai');
            $table->string('GL_biaya_non_tunai')->nullable()->after('biaya_non_tunai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemetaan_akuns', function (Blueprint $table) {
            //
        });
    }
}
