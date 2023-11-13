<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuePendanaanInPemetaanAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemetaan_akuns', function (Blueprint $table) {
            $table->string('pendanaan')->nullable()->after('GL_biaya_non_tunai');
            $table->string('GL_pendanaan')->nullable()->after('pendanaan');
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
