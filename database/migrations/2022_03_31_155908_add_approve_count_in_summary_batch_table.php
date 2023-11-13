<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApproveCountInSummaryBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('summary_batches', function (Blueprint $table) {
            $table->integer('approved')->after('gl_hutang_margin')->nullable();
            $table->integer('rejected')->after('approved')->nullable();
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
            //
        });
    }
}
