<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Admin;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin');
    }


    public function it_creates_a_product_successfully_with_required_attributes()
    {
        $category = Category::factory()->create();
        $attribute = Attribute::factory()->create();

        $category->attributes()->attach($attribute->id, ['required' => true]);

        $response = $this->post(route('admin.products.store'), [
            'name' => 'Test Product',
            'category_id' => $category->id,
            'attributes' => [
                $attribute->id => 'XL', 
            ]
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }


    public function it_fails_validation_if_product_name_is_missing()
    {
        $category = Category::factory()->create();

        $response = $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
        ]);

        $response->assertSessionHasErrors(['name']);
    }


    public function it_fails_if_required_attributes_are_missing()
    {
        $category = Category::factory()->create();
        $attribute = Attribute::factory()->create();

        $category->attributes()->attach($attribute->id, ['required' => true]);

        $response = $this->post(route('admin.products.store'), [
            'name' => 'Incomplete Product',
            'category_id' => $category->id,
            'attributes' => [], 
        ]);

        $response->assertSessionHasErrors(['attributes.' . $attribute->id]);
        $this->assertDatabaseMissing('products', ['name' => 'Incomplete Product']);
    }
}
