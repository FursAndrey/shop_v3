<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert(
            [
                ['user_name'=>'Jon Doe', 'user_email'=>'qwerty@mail.ru', 'description'=>'', 'total_price'=>12.50, 'currency_code'=>'BYN', 'status'=>'0'],
                ['user_name'=>'Jon Doe', 'user_email'=>'qwerty@mail.ru', 'description'=>'description description description', 'total_price'=>25, 'currency_code'=>'BYN', 'status'=>'1'],
                ['user_name'=>'Jon Doe', 'user_email'=>'qwerty@mail.ru', 'description'=>'description description', 'total_price'=>50, 'currency_code'=>'BYN', 'status'=>'3'],
            ]
        );
        
        DB::table('ordered_products')->insert(
            [
                ['order_id'=>1, 'sku_id'=>'A0001', 'name_ru'=>'Майка', 'name_en'=>'T-shirt', 'count'=>'1', 'price_for_once'=>12.50],
                ['order_id'=>2, 'sku_id'=>'A0001', 'name_ru'=>'Майка', 'name_en'=>'T-shirt', 'count'=>'2', 'price_for_once'=>12.50],
                ['order_id'=>3, 'sku_id'=>'A0001', 'name_ru'=>'Майка', 'name_en'=>'T-shirt', 'count'=>'4', 'price_for_once'=>12.50],
            ]
        );
        
        DB::table('ordered_properties')->insert(
            [
                ['ordered_product_id'=>1, 'property_name_ru'=>'Размер одежды', 'property_name_en'=>'Size of clothes', 'option_name_ru'=>'S', 'option_name_en'=>'S'],
                ['ordered_product_id'=>1, 'property_name_ru'=>'Цвет', 'property_name_en'=>'Color', 'option_name_ru'=>'Белый', 'option_name_en'=>'White'],
                ['ordered_product_id'=>2, 'property_name_ru'=>'Размер одежды', 'property_name_en'=>'Size of clothes', 'option_name_ru'=>'S', 'option_name_en'=>'S'],
                ['ordered_product_id'=>2, 'property_name_ru'=>'Цвет', 'property_name_en'=>'Color', 'option_name_ru'=>'Белый', 'option_name_en'=>'White'],
                ['ordered_product_id'=>3, 'property_name_ru'=>'Размер одежды', 'property_name_en'=>'Size of clothes', 'option_name_ru'=>'S', 'option_name_en'=>'S'],
                ['ordered_product_id'=>3, 'property_name_ru'=>'Цвет', 'property_name_en'=>'Color', 'option_name_ru'=>'Белый', 'option_name_en'=>'White'],
            ]
        );
    }
}