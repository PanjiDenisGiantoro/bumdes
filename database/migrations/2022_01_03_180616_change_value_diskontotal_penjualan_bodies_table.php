<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeValueDiskontotalPenjualanBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan_bodies', function (Blueprint $table) {
            $table->string('harga_produk')->nullable()->after('termin')->change();
            $table->string('total_amount')->nullable()->after('harga_produk')->change();
            $table->string('pajak_type')->nullable()->after('total_amount')->change();
            $table->string('total_ppn')->nullable()->after('pajak_type')->change();
            $table->string('total_pph')->nullable()->after('total_ppn')->change();
            $table->string('total_diskon')->nullable()->after('total_pph')->change();
            $table->string('total_amount_all')->nullable()->after('total_diskon')->change();
            $table->string('pajak')->nullable()->after('total_amount_all')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
