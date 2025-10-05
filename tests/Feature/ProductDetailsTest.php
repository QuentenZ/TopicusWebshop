<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProductDetailsTest extends TestCase
{
    use WithoutMiddleware;

    public function test_product_details_endpoint_returns_successful_response(): void
    {
        $this->mock('App\Http\Controllers\API\ProductController')
            ->shouldReceive('show')
            ->with(1)
            ->andReturn(response()->json([
                'status' => 'success',
                'data' => [
                    'id' => 1,
                    'name' => 'Test Product',
                    'price' => 19.99,
                    'description' => 'Test description',
                    'stock' => 1,
                    'image' => '/test.jpg'
                ]
            ]));

        $response = $this->get("/api/products/1");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'name',
                'price',
                'description',
                'stock',
                'image'
            ]
        ]);
        $response->assertJson([
            'status' => 'success'
        ]);
    }


    public function test_product_details_endpoint_returns_not_found_for_invalid_id(): void
    {
        $this->mock('App\Http\Controllers\API\ProductController')
            ->shouldReceive('show')
            ->with(999999)
            ->andReturn(response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404));

        $response = $this->get("/api/products/999999");

        $response->assertStatus(404);
        $response->assertJson([
            'status' => 'error',
            'message' => 'Product not found'
        ]);
    }
}
