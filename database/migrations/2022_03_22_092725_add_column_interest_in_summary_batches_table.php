<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInterestInSummaryBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('summary_batches', function (Blueprint $table) {
            $table->decimal('plafond_pembiayaan', 13, 2)->after('nominal_dana')->nullable();
            $table->decimal('interest', 13, 2)->after('plafond_pembiayaan')->nullable();
            
            $table->integer('jumlah_pengajuan')->after('gl_hutang_margin')->nullable();
            $table->integer('pengajuan_disetujui')->after('jumlah_pengajuan')->nullable();
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
            $table->dropColumn('plafond_pembiayaan');
            $table->dropColumn('interest');
        });
    }
}
