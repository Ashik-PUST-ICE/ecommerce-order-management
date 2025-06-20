<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            OutletsTableSeeder::class,
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}
