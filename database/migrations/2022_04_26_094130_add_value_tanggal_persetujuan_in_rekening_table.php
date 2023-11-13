<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueTanggalPersetujuanInRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening', function (Blueprint $table) {
            $table->string('tanggal_persetujuan')->nullable()->after('tanggal_pengajuan');
            $table->string('keterangan')->nullable()->after('tanggal_persetujuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rekening', function (Blueprint $table) {
            //
        });
    }
}
