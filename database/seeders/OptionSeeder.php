<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_options')->insert(
            [
                ['name_ru'=>'S', 'name_en'=>'S', 'property_id'=>1],
                ['name_ru'=>'M', 'name_en'=>'M', 'property_id'=>1],
                ['name_ru'=>'L', 'name_en'=>'L', 'property_id'=>1],
                ['name_ru'=>'Белый', 'name_en'=>'White', 'property_id'=>2],
                ['name_ru'=>'Синий', 'name_en'=>'Blue', 'property_id'=>2],
                ['name_ru'=>'Красный', 'name_en'=>'Red', 'property_id'=>2],
                ['name_ru'=>'Черный', 'name_en'=>'Black', 'property_id'=>2],
                ['name_ru'=>'Желтый', 'name_en'=>'Yellow', 'property_id'=>2],
                ['name_ru'=>'Зеленый', 'name_en'=>'Green', 'property_id'=>2],
                ['name_ru'=>'0.3 кг', 'name_en'=>'0.3 kg', 'property_id'=>3],
                ['name_ru'=>'0.4 кг', 'name_en'=>'0.4 kg', 'property_id'=>3],
                ['name_ru'=>'0.5 кг', 'name_en'=>'0.5 kg', 'property_id'=>3],
                ['name_ru'=>'0.6 кг', 'name_en'=>'0.6 kg', 'property_id'=>3],
                ['name_ru'=>'0.7 кг', 'name_en'=>'0.7 kg', 'property_id'=>3],
                ['name_ru'=>'100 мм', 'name_en'=>'100 mm', 'property_id'=>4],
                ['name_ru'=>'200 мм', 'name_en'=>'200 mm', 'property_id'=>4],
                ['name_ru'=>'300 мм', 'name_en'=>'300 mm', 'property_id'=>4],
                ['name_ru'=>'400 мм', 'name_en'=>'400 mm', 'property_id'=>4],
            ]
        );
    }
}
