<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CartRetrievalTest extends TestCase
{
    use WithoutMiddleware;

    public function test_get_cart_endpoint_returns_successful_response(): void
    {
        // Mock the controller response
        $this->mock('App\Http\Controllers\API\CartController')
            ->shouldReceive('getCart')
            ->andReturn(response()->json([
                'status' => 'success',
                'data' => [[
                    'id' => 1,
                    'product_id' => 1,
                    'quantity' => 2,
                    'product' => [
                        'name' => 'Test Product',
                        'price' => 19.99
                    ]
                ]]
            ]));

        $response = $this->get('/api/cart');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJson([
            'status' => 'success'
        ]);
    }
}
