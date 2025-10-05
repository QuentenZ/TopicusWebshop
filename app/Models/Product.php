<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_path'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * @return Collection
     */
    public static function getAllProducts(): Collection
    {
        return self::all();
    }

    /**
     * @param int $quantity
     * @return bool
     */
    public function updateStock(int $quantity): bool
    {
        try {
            DB::beginTransaction();

            if ($this->stock + $quantity < 0) {
                DB::rollBack();
                return false;
            }

            $this->stock += $quantity;
            $result = $this->save();

            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
