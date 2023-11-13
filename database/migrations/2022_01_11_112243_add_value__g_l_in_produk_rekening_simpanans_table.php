<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueGLInProdukRekeningSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_rekening_simpanans', function (Blueprint $table) {
            $table->string('GL_biaya_admin')->nullable()->after('zakat_basil');
            $table->string('GL_biaya_materai')->nullable()->after('GL_biaya_admin');
            $table->string('GL_biaya_registrasi')->nullable()->after('GL_biaya_materai');
            $table->string('GL_biaya_asuransi')->nullable()->after('GL_biaya_registrasi');
            $table->string('GL_biaya_penutupan_rekening')->nullable()->after('GL_biaya_asuransi');
            $table->string('GL_biaya_transfer_luar')->nullable()->after('GL_biaya_penutupan_rekening');
            $table->string('GL_produk_simpanan')->nullable()->after('GL_biaya_transfer_luar');
            $table->string('GL_titipan_pph')->nullable()->after('GL_produk_simpanan');
            $table->string('GL_titipan_zakat')->nullable()->after('GL_titipan_pph');
            $table->string('GL_beban_bagi_hasil')->nullable()->after('GL_titipan_zakat');
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
