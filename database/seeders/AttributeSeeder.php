<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\Category;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $size = Attribute::create(['name' => 'Size']);
        $color = Attribute::create(['name' => 'Color']);
        $material = Attribute::create(['name' => 'Material']);

        // Assign to Clothing
        $clothing = Category::where('name', 'Clothing')->first();

        if ($clothing) {
            $clothing->attributes()->attach([
                $size->id => ['is_required' => true],
                $color->id => ['is_required' => true],
                $material->id => ['is_required' => false],
            ]);
        }
    }
}
