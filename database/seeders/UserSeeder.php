<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                ['name'=>'admin', 'email'=>'admin@admin.com', 'password'=>bcrypt('admin@admin.com')],
                ['name'=>'user', 'email'=>'user@user.com', 'password'=>bcrypt('user@user.com')],
                ['name'=>'seller', 'email'=>'seller@seller.com', 'password'=>bcrypt('seller@seller.com')],
            ]
        );
        
        DB::table('roles')->insert(
            [
                ['name_ru'=>'Админ', 'name_en'=>'Admin', 'description_ru'=>'Администратор сайта', 'description_en'=>'Admin of this shop'],
                ['name_ru'=>'Продавец', 'name_en'=>'Seller', 'description_ru'=>'Продавец на сайте', 'description_en'=>'Seller of this shop'],
            ]
        );
        
        DB::table('role_user')->insert(
            [
                ['role_id'=>'1', 'user_id'=>'1'],
                ['role_id'=>'2', 'user_id'=>'3'],
            ]
        );
    }
}
