<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    protected $fillable = [
        'session_id',
        'product_id',
        'quantity'
    ];

    /**
     * Get the product from the cart.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all cart items by session ID
     *
     * @param string $sessionId
     * @return Collection
     */
    public static function getCartItems(string $sessionId): Collection
    {
        return self::with('product')->where('session_id', $sessionId)->get();
    }

    /**
     * @param string $sessionId
     * @param int $productId
     * @param int $quantity
     * @return CartItem|null
     */
    public static function addToCart(string $sessionId, int $productId, int $quantity): ?CartItem
    {
        try {
            DB::beginTransaction();

            $existingItemInCart = self::where('session_id', $sessionId)->where('product_id', $productId)->first();
            if ($existingItemInCart) {
                //update existing cart item
                $cartItem = $existingItemInCart;
                $quantity = $cartItem->quantity + $quantity;
                $cartItem->quantity = $quantity;
            } else {
                //create new cart item
                $cartItem = new self([
                    'session_id' => $sessionId,
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }

            $product = Product::find($productId);
            if (!$product || $product->stock < $quantity || $quantity <= 0) {
                DB::rollBack();
                return null;
            }

            $cartItem->save();
            $product->updateStock(-$quantity);
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }

        DB::commit();
        return $cartItem;
    }

    /**
     * @param int $quantity
     * @return bool
     */
    public function updateQuantity(int $totalQuantity): bool
    {
        if ($totalQuantity <= 0) {
            return $this->removeFromCart();
        }

        try {
            DB::beginTransaction();
            $this->load('product');

            $quantityDifference = $totalQuantity - $this->quantity;
            if ($quantityDifference > 0 && $this->product->stock < $quantityDifference) {
                DB::rollBack();
                return false;
            }

            $this->quantity = $totalQuantity;
            $this->save();
            $this->product->updateStock(-$quantityDifference);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function removeFromCart(): bool
    {
        try {
            DB::beginTransaction();

            $this->product->updateStock($this->quantity);
            $result = $this->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

        return $result;
    }
}
