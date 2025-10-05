<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCart(Request $request): JsonResponse
    {
        $sessionId = $request->session()->getId();
        $cartItems = CartItem::getCartItems($sessionId);

        return response()->json([
            'status' => 'success',
            'data' => $cartItems
        ]);
    }

    /**
     * Add item to cart
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addToCart(Request $request): JsonResponse
    {
        //TODO: Write function
        return response()->json([
            'status' => 'error',
            'message' => 'Unfinished function'
        ], 404);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateCartItem(Request $request, int $id): JsonResponse
    {
        //TODO: Write function
        return response()->json([
            'status' => 'error',
            'message' => 'Unfinished function'
        ], 404);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function removeFromCart(Request $request, int $id): JsonResponse
    {
        //TODO: Write function
        return response()->json([
            'status' => 'error',
            'message' => 'Unfinished function'
        ], 404);
    }
}
