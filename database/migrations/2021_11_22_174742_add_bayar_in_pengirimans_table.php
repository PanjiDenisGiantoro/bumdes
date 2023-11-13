<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBayarInPengirimansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->string('bayar')->default(0)->after('total');
            $table->string('sisa_tagihan')->default(0)->after('bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            //
        });
    }
}
