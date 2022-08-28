<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyForOrderedProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordered_properties', function (Blueprint $table) {
            $table->foreign('ordered_product_id')->references('id')->on('ordered_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordered_properties', function (Blueprint $table) {
            $table->dropForeign(['ordered_product_id']);
            $table->dropIndex('ordered_properties_ordered_product_id_foreign');
        });
    }
}
