<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValueTypeSupplierInSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->string('npwp')->nullable()->after('no_hp');
            $table->string('id_tipe_supplier')->nullable()->after('npwp');
            $table->string('id_akun_hutang')->nullable()->after('id_tipe_supplier');
            $table->string('id_akun_piutang')->nullable()->after('id_akun_hutang');
            $table->string('no_telepon')->nullable()->change();
            $table->string('no_hp')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier', function (Blueprint $table) {
            //
        });
    }
}
