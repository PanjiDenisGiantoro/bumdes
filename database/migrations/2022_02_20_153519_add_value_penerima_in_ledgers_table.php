<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValuePenerimaInLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ledgers', function (Blueprint $table) {
            $table->string('dibayar_dari')->nullable()->after('jenis_transaksi');
            $table->string('penerima')->nullable()->after('dibayar_dari');
            $table->string('jatuh_tempo')->nullable()->after('penerima');
            $table->string('termin')->nullable()->after('jatuh_tempo');
            $table->string('bayar_value')->nullable()->after('termin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ledgers', function (Blueprint $table) {
            //
        });
    }
}
