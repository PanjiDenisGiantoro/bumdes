<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueKodeCabangInPenomoranAutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penomoran_auto', function (Blueprint $table) {
            $table->string('kode_cabang')->nullable()->after('keterangan');
            $table->string('kode_perusahaan')->nullable()->after('kode_cabang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penomoran_auto', function (Blueprint $table) {
            //
        });
    }
}
