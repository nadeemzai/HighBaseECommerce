<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;

class AttributeValueSeeder extends Seeder
{
    public function run(): void
    {
        $size = Attribute::where('name', 'Size')->first();
        $color = Attribute::where('name', 'Color')->first();
        $material = Attribute::where('name', 'Material')->first();

        if ($size) {
            foreach (['S', 'M', 'L', 'XL'] as $value) {
                AttributeValue::create([
                    'attribute_id' => $size->id,
                    'value' => $value,
                    'product_id' => Product::factory()->create()->id
                ]);
            }
        }

        if ($color) {
            foreach (['Red', 'Blue', 'Black', 'White'] as $value) {
                AttributeValue::create([
                    'attribute_id' => $color->id,
                    'value' => $value,
                    'product_id' => Product::factory()->create()->id
                ]);
            }
        }

        if ($material) {
            foreach (['Cotton', 'Polyester', 'Wool'] as $value) {
                AttributeValue::create([
                    'attribute_id' => $material->id,
                    'value' => $value,
                    'product_id' => Product::factory()->create()->id
                ]);
            }
        }
    }
}
