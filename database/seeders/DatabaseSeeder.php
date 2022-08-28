<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SkuSeeder::class);
        $this->call(OrderSeeder::class);
    }
}