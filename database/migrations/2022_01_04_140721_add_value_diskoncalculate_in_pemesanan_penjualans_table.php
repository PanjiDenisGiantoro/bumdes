<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueDiskoncalculateInPemesananPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan_penjualans', function (Blueprint $table) {
            $table->string('diskoncalculate')->nullable()->after('diskon_per_item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan_penjualans', function (Blueprint $table) {
            //
        });
    }
}
