<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_product()
    {
        $product = Product::factory()->create();
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_can_update_product_price()
    {
        $product = Product::factory()->create();
        $product->update(['price' => 999.99]);
        $this->assertEquals(999.99, $product->fresh()->price);
    }
}
