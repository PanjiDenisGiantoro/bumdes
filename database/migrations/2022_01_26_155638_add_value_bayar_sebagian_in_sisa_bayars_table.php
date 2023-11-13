<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueBayarSebagianInSisaBayarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sisa_bayars', function (Blueprint $table) {
            $table->string('bayar_sebagian')->nullable()->after('sisa_bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sisa_bayars', function (Blueprint $table) {
            //
        });
    }
}
