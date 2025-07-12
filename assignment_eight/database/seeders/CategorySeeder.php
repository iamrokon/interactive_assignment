<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can use the CategoryFactory to create categories
        \App\Models\Category::factory()->count(10)->create();

        // If you want to create a hierarchy, you can do so here
        // For example, creating a parent category and child categories
        $parentCategory = \App\Models\Category::factory()->create(['name' => 'Parent Category']);
        \App\Models\Category::factory()->count(5)->create(['parent_id' => $parentCategory->id]);
    }
}
