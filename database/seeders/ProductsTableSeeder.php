<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Laptop',
            'description' => 'High performance laptop',
            'price' => 999.99,
            'stock' => 50
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest smartphone model',
            'price' => 699.99,
            'stock' => 100
        ]);

        Product::create([
            'name' => 'Headphones',
            'description' => 'Noise cancelling headphones',
            'price' => 199.99,
            'stock' => 75
        ]);
    }
}
