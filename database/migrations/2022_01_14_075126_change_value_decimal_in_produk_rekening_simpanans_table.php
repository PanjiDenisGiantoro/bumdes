<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeValueDecimalInProdukRekeningSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk_rekening_simpanans', function (Blueprint $table) {
            $table->float('storan_minimal')->nullable()->change();
            $table->float('storan_selanjut')->nullable()->change();
            $table->float('saldo_mengendap')->nullable()->change();
            $table->float('penalti')->nullable()->change();
            $table->float('biaya_admin')->nullable()->change();
            $table->float('biaya_materai')->nullable()->change();
            $table->float('biaya_asuransi')->nullable()->change();
            $table->float('biaya_registrasi')->nullable()->change();
            $table->float('biaya_penutupan_rekening')->nullable()->change();
            $table->float('biaya_transfer_luar')->nullable()->change();
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
