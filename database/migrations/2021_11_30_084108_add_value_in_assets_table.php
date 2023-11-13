<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueInAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asets', function (Blueprint $table) {
            $table->string('jumlah_aset')->nullable()->after('nama_aset');
            $table->string('akhir_masa_manfaat')->nullable()->after('nilai');
            $table->string('perbedaan_bulan')->nullable()->after('akhir_masa_manfaat');
            $table->string('penyusutan_bulanan')->nullable()->after('perbedaan_bulan');
            $table->string('total_penyusutan')->nullable()->after('penyusutan_bulanan');
            $table->string('perkiraan_akhir_buku')->nullable()->after('total_penyusutan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            //
        });
    }
}
