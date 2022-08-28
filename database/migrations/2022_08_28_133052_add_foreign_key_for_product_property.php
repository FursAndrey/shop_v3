<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyForProductProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_property', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_property', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropIndex('product_property_product_id_foreign');
            $table->dropForeign(['property_id']);
            $table->dropIndex('product_property_property_id_foreign');
        });
    }
}
