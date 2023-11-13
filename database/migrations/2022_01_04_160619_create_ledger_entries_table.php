<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgerEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ledger_id')->nullable();
            $table->morphs('ledgerable');
            $table->string('money_to')->nullable();
            $table->string('money_from')->nullable();
            $table->text('reason');
            $table->boolean('credit')->default(0);
            $table->boolean('debit')->default(0);
            $table->float('amount', 13, 2);
            $table->string('amount_currency')->nullable();
            $table->float('current_balance', 13, 2);
            $table->string('current_balance_currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledger_entries');
    }
}
