<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class AddFewColumnInSummaryBatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('summary_batches', function (Blueprint $table) {
            $table->string('sumber_pendanaan')->after('id')->nullable();
            $table->decimal('nominal_dana', 13, 2)->after('sumber_pendanaan')->nullable();
            $table->bigInteger('rekening_simpanan_id')->after('nominal_dana')->nullable();
            $table->string('nama_pembiayaan')->after('batch')->nullable();
            $table->decimal('biaya_pendapatan_koperasi', 13, 2)->after('nama_pembiayaan')->nullable();
            $table->decimal('biaya_admin_pendana', 13, 2)->after('biaya_pendapatan_koperasi')->nullable();
            $table->decimal('biaya_hutang_margin', 13, 2)->after('biaya_admin_pendana')->nullable();
            $table->bigInteger('gl_pembiayaan_pendanaan')->after('biaya_hutang_margin')->nullable();
            $table->bigInteger('gl_pendapatan_koperasi')->after('gl_pembiayaan_pendanaan')->nullable();
            $table->bigInteger('gl_admin_pendana')->after('gl_pendapatan_koperasi')->nullable();
            $table->bigInteger('gl_hutang_margin')->after('gl_admin_pendana')->nullable();
            $table->string('jangka_waktu')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summary_batches', function (Blueprint $table) {
            $table->dropColumn(['sumber_pendanaan', 'nominal_dana', 'rekening_simpanan_id', 
                'nama_pembiayaan', 'biaya_pendapatan_koperasi', 'biaya_admin_pendana', 'biaya_hutang_margin', 'gl_pembiayaan_pendanaan', 'gl_pendapatan_koperasi',
                'gl_admin_pendana', 'gl_hutang_margin'
            ]);
        });
    }
}
