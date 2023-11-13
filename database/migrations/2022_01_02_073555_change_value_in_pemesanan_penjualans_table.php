<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeValueInPemesananPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan_penjualans', function (Blueprint $table) {
            $table->string('diskon_per_item')->default(0)->nullable()->after('pajaktotal');
            $table->string('PPN')->default(0)->nullable()->after('diskon_per_item');
            $table->string('PPH')->default(0)->nullable()->after('PPN');
            $table->string('diskontotalrupiah')->nullable()->default(0)->after('PPH');
            $table->string('diskontotal')->nullable()->default(0)->after('diskontotalrupiah');

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
