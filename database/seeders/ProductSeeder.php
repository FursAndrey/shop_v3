<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                ['name_ru'=>'Майка', 'name_en'=>'T-shirt', 'img'=>'1.jpg', 'category_id'=>1, 'description_ru'=>'Майка', 'description_en'=>'T-shirt'],
                ['name_ru'=>'Куртка', 'name_en'=>'Jacket', 'img'=>'2.jpg', 'category_id'=>1, 'description_ru'=>'Куртка', 'description_en'=>'Jacket'],
                ['name_ru'=>'Толстовка', 'name_en'=>'Sweatshirt', 'img'=>'3.jpg', 'category_id'=>1, 'description_ru'=>'Толстовка', 'description_en'=>'Sweatshirt'],
                ['name_ru'=>'Молоток', 'name_en'=>'Hammer', 'img'=>'4.jpg', 'category_id'=>2, 'description_ru'=>'Молоток', 'description_en'=>'Hammer'],
                ['name_ru'=>'Пила', 'name_en'=>'Saw', 'img'=>'5.png', 'category_id'=>2, 'description_ru'=>'Пила', 'description_en'=>'Saw'],
                ['name_ru'=>'Отвертка', 'name_en'=>'Screwdriver', 'img'=>'6.jpg', 'category_id'=>2, 'description_ru'=>'Отвертка', 'description_en'=>'Screwdriver'],
                ['name_ru'=>'Брелок', 'name_en'=>'Trinket', 'img'=>'7.jpg', 'category_id'=>3, 'description_ru'=>'Брелок', 'description_en'=>'Trinket'],
                ['name_ru'=>'Магнит', 'name_en'=>'Magnet', 'img'=>'8.jpg', 'category_id'=>3, 'description_ru'=>'Магнит на холодильник', 'description_en'=>'Magnet for a fridge'],
            ]
        );

        DB::table('product_property')->insert(
            [
                ['property_id'=>1, 'product_id'=>1],
                ['property_id'=>2, 'product_id'=>1],
                ['property_id'=>1, 'product_id'=>2],
                ['property_id'=>2, 'product_id'=>2],
                ['property_id'=>1, 'product_id'=>3],
                ['property_id'=>2, 'product_id'=>3],
                ['property_id'=>3, 'product_id'=>4],
                ['property_id'=>4, 'product_id'=>5],
                ['property_id'=>4, 'product_id'=>6],
                ['property_id'=>2, 'product_id'=>7],
                ['property_id'=>2, 'product_id'=>8],
            ]
        );
    }
}
