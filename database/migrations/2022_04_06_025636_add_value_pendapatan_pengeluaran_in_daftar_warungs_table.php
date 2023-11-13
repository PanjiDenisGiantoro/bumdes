<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuePendapatanPengeluaranInDaftarWarungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daftar_warungs', function (Blueprint $table) {
            $table->string('pendapatan')->nullable()->after('coordinates');
            $table->string('pengeluaran')->nullable()->after('pendapatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daftar_warungs', function (Blueprint $table) {
            //
        });
    }
}
