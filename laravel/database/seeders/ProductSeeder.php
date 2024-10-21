<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'price' => rand(10, 1000),
                'description' => 'This is a description for product ' . $i,
                'image' => 'https://via.placeholder.com/150', // Placeholder image
            ]);
        }
    }
}
