<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordered_product_id');
            $table->string('property_name_ru');
            $table->string('property_name_en');
            $table->string('option_name_ru');
            $table->string('option_name_en');
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
        Schema::dropIfExists('ordered_properties');
    }
}
