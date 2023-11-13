<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueGLPenampunganSementaraInProdukRekeningSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_rekening_simpanans', function (Blueprint $table) {
            $table->string('GL_penampungan_sementara')->nullable()->after('GL_beban_bagi_hasil');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk_rekening_simpanans', function (Blueprint $table) {
            //
        });
    }
}
