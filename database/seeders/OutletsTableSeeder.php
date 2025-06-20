<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletsTableSeeder extends Seeder
{
    public function run()
    {
        Outlet::create(['name' => 'Main Outlet', 'location' => 'Downtown']);
        Outlet::create(['name' => 'North Outlet', 'location' => 'North Area']);
        Outlet::create(['name' => 'South Outlet', 'location' => 'South Area']);
    }
}
