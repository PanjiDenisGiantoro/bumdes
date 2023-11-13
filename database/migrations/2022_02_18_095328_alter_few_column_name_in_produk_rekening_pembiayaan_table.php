<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFewColumnNameInProdukRekeningPembiayaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_rekening_pembiayaans', function (Blueprint $table) {
            $table->renameColumn('akad_simpanan', 'akad_pembiayaan');
            $table->renameColumn('kode_simpanan', 'kode_pembiayaan');
            $table->renameColumn('nama_simpanan', 'nama_pembiayaan');
            $table->renameColumn('storan_minimal', 'minimal_pembiayaan');
            $table->renameColumn('storan_maksimal', 'maksimal_pembiayaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_rekening_pembiayaan', function (Blueprint $table) {
            //
        });
    }
}
