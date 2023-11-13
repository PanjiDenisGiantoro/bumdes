<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNestedsetFieldsToAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akuns', function (Blueprint $table) {
            $table->char('jenis')->after('arus_kas_aktifitas');
            $table->nestedSet();
            $table->dropColumn('kode_kelompok_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('akuns', function (Blueprint $table) {
            //
        });
    }
}
