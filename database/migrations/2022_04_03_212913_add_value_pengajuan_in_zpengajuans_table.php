<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuePengajuanInZpengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zpengajuans', function (Blueprint $table) {
            $table->string('provinsi')->nullable()->after('desa');
            $table->string('kecamatan')->nullable()->after('provinsi');
            $table->string('keterangan_usaha')->nullable()->after('kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zpengajuans', function (Blueprint $table) {
            //
        });
    }
}
