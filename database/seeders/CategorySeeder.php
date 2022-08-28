<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                ['name_ru'=>'Одежда', 'name_en'=>'Clothes', 'code'=>'Clth', 'description_ru'=>'Модная одежда', 'description_en'=>'Fashion clothes'],
                ['name_ru'=>'Инструменты', 'name_en'=>'Tools', 'code'=>'Tool', 'description_ru'=>'Нужные инструменты', 'description_en'=>'Helpful tools'],
                ['name_ru'=>'Сувениры', 'name_en'=>'Souvenirs', 'code'=>'Svnr', 'description_ru'=>'Крутые сувениры', 'description_en'=>'Cool souvenirs'],
            ]
        );
    }
}
