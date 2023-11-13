<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInteresInProdukPembiayaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_rekening_pembiayaans', function (Blueprint $table) {
            $table->decimal('interest', 13, 2)->after('maksimal_pembiayaan')->nullable();
            $table->decimal('nisbah_koperasi')->after('nisbah')->nullable();
            $table->renameColumn('nisbah', 'nisbah_anggota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_rekening_pembiayaans', function (Blueprint $table) {
            //
        });
    }
}
