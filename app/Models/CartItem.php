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
     *
     * Get the product that this cart item belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get cart items by session ID
     *
     * @param string $sessionId
     * @return Collection
     */
    public static function getCartItems(string $sessionId): Collection
    {
        return self::with('product')->where('session_id', $sessionId)->get();
    }

    /**
     * Add item to cart
     *
     * @param string $sessionId
     * @param int $productId
     * @param int $quantity
     * @return CartItem|null
     */
    public static function addToCart(string $sessionId, int $productId, int $quantity): ?CartItem
    {
        try {
            DB::beginTransaction();

            $product = Product::find($productId);

            if (!$product || $product->stock < $quantity || $quantity <= 0) {
                DB::rollBack();
                return null;
            }

            // Check if product already in cart
            $existingItem = self::where('session_id', $sessionId)
                ->where('product_id', $productId)
                ->first();

            if ($existingItem) {
                // Update quantity of existing cart item
                $newQuantity = $existingItem->quantity + $quantity;

                if ($product->stock < $newQuantity) {
                    DB::rollBack();
                    return null;
                }

                $existingItem->quantity = $newQuantity;
                $existingItem->save();

                // Update stock
                $product->updateStock(-$quantity);

                DB::commit();
                return $existingItem;
            }

            // Create new cart item
            $cartItem = new self([
                'session_id' => $sessionId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);

            $cartItem->save();

            // Update stock
            $product->updateStock(-$quantity);

            DB::commit();
            return $cartItem;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * Update cart item quantity
     *
     * @param int $quantity
     * @return bool
     */
    public function updateQuantity(int $quantity): bool
    {
        try {
            DB::beginTransaction();

            $this->load('product');

            $quantityDifference = $quantity - $this->quantity;

            // Check if we have enough stock for the increased quantity
            if ($quantityDifference > 0 && $this->product->stock < $quantityDifference) {
                DB::rollBack();
                return false;
            }

            // If quantity is 0 or less, remove item from cart
            if ($quantity <= 0) {
                return $this->removeFromCart();
            }

            // Update cart item quantity
            $this->quantity = $quantity;
            $this->save();

            // Update stock
            $this->product->updateStock(-$quantityDifference);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Remove item from cart
     *
     * @return bool
     */
    public function removeFromCart(): bool
    {
        try {
            DB::beginTransaction();

            // Return quantity to product stock
            $this->product->updateStock($this->quantity);

            // Delete cart item
            $result = $this->delete();

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
