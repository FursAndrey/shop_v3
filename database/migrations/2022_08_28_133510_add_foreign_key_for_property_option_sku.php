<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyForPropertyOptionSku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_option_sku', function (Blueprint $table) {
            $table->foreign('property_option_id')->references('id')->on('property_options');
            $table->foreign('sku_id')->references('id')->on('skus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_option_sku', function (Blueprint $table) {
            $table->dropForeign(['property_option_id']);
            $table->dropIndex('property_option_sku_property_option_id_foreign');
            $table->dropForeign(['sku_id']);
            $table->dropIndex('property_option_sku_sku_id_foreign');
        });
    }
}
