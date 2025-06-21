<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parent = Category::create(['name' => 'Clothing']);
        Category::create(['name' => 'Men', 'parent_id' => $parent->id]);
        Category::create(['name' => 'Women', 'parent_id' => $parent->id]);

        $food = Category::create(['name' => 'Food']);
        $veg = Category::create(['name' => 'Vegetables', 'parent_id' => $food->id]);
        Category::create(['name' => 'Leafy', 'parent_id' => $veg->id]);
    }
}
