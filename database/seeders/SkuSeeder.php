<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skus')->insert(
            [
                ['price'=>12.5, 'count'=>15, 'product_id'=>1, 'currency_id'=>1],
                ['price'=>13.5, 'count'=>15, 'product_id'=>1, 'currency_id'=>1],
                ['price'=>11.5, 'count'=>15, 'product_id'=>1, 'currency_id'=>1],
                ['price'=>15.5, 'count'=>15, 'product_id'=>1, 'currency_id'=>1],

                ['price'=>45.5, 'count'=>15, 'product_id'=>2, 'currency_id'=>1],
                ['price'=>44.5, 'count'=>15, 'product_id'=>2, 'currency_id'=>1],
                ['price'=>42.5, 'count'=>15, 'product_id'=>2, 'currency_id'=>1],
                ['price'=>46.5, 'count'=>15, 'product_id'=>2, 'currency_id'=>1],

                ['price'=>22.5, 'count'=>15, 'product_id'=>3, 'currency_id'=>1],
                ['price'=>24.5, 'count'=>15, 'product_id'=>3, 'currency_id'=>1],
                ['price'=>23.5, 'count'=>15, 'product_id'=>3, 'currency_id'=>1],
                ['price'=>26.5, 'count'=>15, 'product_id'=>3, 'currency_id'=>1],

                ['price'=>10.5, 'count'=>15, 'product_id'=>4, 'currency_id'=>1],
                ['price'=>15.5, 'count'=>15, 'product_id'=>4, 'currency_id'=>1],
                ['price'=>20.5, 'count'=>15, 'product_id'=>4, 'currency_id'=>1],

                ['price'=>10.5, 'count'=>15, 'product_id'=>5, 'currency_id'=>1],
                ['price'=>11.5, 'count'=>15, 'product_id'=>5, 'currency_id'=>1],

                ['price'=>12.5, 'count'=>15, 'product_id'=>6, 'currency_id'=>1],

                ['price'=>2.5, 'count'=>15, 'product_id'=>7, 'currency_id'=>1],
                ['price'=>2.5, 'count'=>15, 'product_id'=>7, 'currency_id'=>1],
                ['price'=>2.5, 'count'=>15, 'product_id'=>7, 'currency_id'=>1],

                ['price'=>5.5, 'count'=>15, 'product_id'=>8, 'currency_id'=>1],
                ['price'=>5.5, 'count'=>15, 'product_id'=>8, 'currency_id'=>1],
            ]
        );
        
        DB::table('property_option_sku')->insert(
            [
                ['property_option_id'=>1, 'sku_id'=>1],
                ['property_option_id'=>4, 'sku_id'=>1],
                ['property_option_id'=>2, 'sku_id'=>2],
                ['property_option_id'=>6, 'sku_id'=>2],
                ['property_option_id'=>2, 'sku_id'=>3],
                ['property_option_id'=>7, 'sku_id'=>3],
                ['property_option_id'=>3, 'sku_id'=>4],
                ['property_option_id'=>7, 'sku_id'=>4],

                ['property_option_id'=>1, 'sku_id'=>5],
                ['property_option_id'=>4, 'sku_id'=>5],
                ['property_option_id'=>2, 'sku_id'=>6],
                ['property_option_id'=>6, 'sku_id'=>6],
                ['property_option_id'=>2, 'sku_id'=>7],
                ['property_option_id'=>7, 'sku_id'=>7],
                ['property_option_id'=>3, 'sku_id'=>8],
                ['property_option_id'=>7, 'sku_id'=>8],

                ['property_option_id'=>1, 'sku_id'=>9],
                ['property_option_id'=>4, 'sku_id'=>9],
                ['property_option_id'=>2, 'sku_id'=>10],
                ['property_option_id'=>6, 'sku_id'=>10],
                ['property_option_id'=>2, 'sku_id'=>11],
                ['property_option_id'=>7, 'sku_id'=>11],
                ['property_option_id'=>3, 'sku_id'=>12],
                ['property_option_id'=>7, 'sku_id'=>12],

                ['property_option_id'=>10, 'sku_id'=>13],
                ['property_option_id'=>12, 'sku_id'=>14],
                ['property_option_id'=>14, 'sku_id'=>15],

                ['property_option_id'=>16, 'sku_id'=>16],
                ['property_option_id'=>18, 'sku_id'=>17],

                ['property_option_id'=>15, 'sku_id'=>18],

                ['property_option_id'=>4, 'sku_id'=>19],
                ['property_option_id'=>5, 'sku_id'=>20],
                ['property_option_id'=>7, 'sku_id'=>21],

                ['property_option_id'=>6, 'sku_id'=>22],
                ['property_option_id'=>8, 'sku_id'=>23],
            ]
        );
    }
}
