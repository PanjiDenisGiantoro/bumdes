<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueJangkaWaktuInProdukRekeningSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_rekening_simpanans', function (Blueprint $table) {
            $table->string('nisbah_koperasi')->nullable()->after('saldo_mengendap');
            $table->string('nisbah_anggota')->nullable()->after('nisbah_koperasi');
            $table->string('bagi_hasil')->nullable()->after('nisbah_anggota');
            $table->string('boleh_transfer')->nullable()->after('bagi_hasil');
            $table->smallInteger('ada_ao')->default(0)->after('status');
            $table->smallInteger('ada_shu')->default(0)->after('ada_ao');
            $table->smallInteger('ada_bonus')->default(0)->after('ada_shu');
            $table->smallInteger('ada_bagi_hasil')->default(0)->after('ada_bonus');
            $table->smallInteger('lock_rekening')->default(0)->after('ada_bagi_hasil');
            $table->string('tanggal_selesai_lock')->nullable()->after('GL_beban_bagi_hasil');


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
