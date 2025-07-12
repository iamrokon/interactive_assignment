<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can use the ProductFactory to create products
        \App\Models\Product::factory()->count(10)->create();

        // If you want to associate products with categories, you can do so here
        $categories = \App\Models\Category::all();
        foreach ($categories as $category) {
            \App\Models\Product::factory()->count(3)->create(['category_id' => $category->id]);
        }
    }
}
