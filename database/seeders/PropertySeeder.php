<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert(
            [
                ['name_ru'=>'Размер одежды', 'name_en'=>'Size of clothes'],
                ['name_ru'=>'Цвет', 'name_en'=>'Color'],
                ['name_ru'=>'Масса', 'name_en'=>'Weight'],
                ['name_ru'=>'Длинна', 'name_en'=>'Lenght'],
            ]
        );
    }
}
