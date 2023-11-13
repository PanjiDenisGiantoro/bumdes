<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFewColumnInSettingBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_batchs', function (Blueprint $table) {
            $table->string('nama_pendana')->after('id')->nullable();
            $table->bigInteger('gl_pendana')->after('nama_pendana')->nullable();
            $table->bigInteger('gl_admin_pendana')->after('gl_pendana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_batchs', function (Blueprint $table) {
            //
        });
    }
}
