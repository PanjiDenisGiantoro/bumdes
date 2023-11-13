<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFewColumnInCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->renameColumn('category', 'category_id');
            $table->renameColumn('product', 'product_id');
            $table->string('product_name')->after('quantity')->nullable();
            $table->string('image')->after('product_name')->nullable();
            $table->decimal('total_price', 13, 2)->after('image')->nullable();
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
            $table->dropColumn('product_name');
            $table->dropColumn('image');
            $table->dropColumn('total_price');
        });
    }
}
