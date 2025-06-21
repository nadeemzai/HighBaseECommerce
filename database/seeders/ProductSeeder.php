<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::where('name', 'Men')->first();

        if ($category) {
            Product::factory()->count(10)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
