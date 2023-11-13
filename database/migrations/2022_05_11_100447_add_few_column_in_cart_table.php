<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFewColumnInCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('user_id')->after('cabang_unit')->nullable();
            $table->integer('category')->after('produks_id')->nullable();
            $table->integer('quantity')->after('category')->nullable();
            $table->integer('satuan')->after('quantity')->nullable();
            $table->decimal('price', 13, 2)->after('satuan')->nullable();

            $table->renameColumn('produks_id', 'product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('user_id', 'category', 'quantity', 'price', 'satuan');
            $table->renameColumn('product', 'produks_id');
        });
    }
}
