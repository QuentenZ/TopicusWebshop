<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Pro X',
                'description' => 'High-performance laptop with 16GB RAM, 512GB SSD, and 15-inch display.',
                'price' => 1299.99,
                'stock' => 25,
                'image_path' => 'images/products/laptop-pro-x.jpg'
            ],
            [
                'name' => 'Smartphone Ultra',
                'description' => 'Latest smartphone with 128GB storage, 6.7-inch OLED display, and 48MP camera.',
                'price' => 899.99,
                'stock' => 50,
                'image_path' => 'images/products/smartphone-ultra.jpg'
            ],
            [
                'name' => 'Wireless Headphones',
                'description' => 'Noise-canceling wireless headphones with 30-hour battery life.',
                'price' => 199.99,
                'stock' => 100,
                'image_path' => 'images/products/wireless-headphones.jpg'
            ],
            [
                'name' => 'Smart Watch Series 5',
                'description' => 'Fitness tracking smartwatch with heart rate monitor and GPS.',
                'price' => 299.99,
                'stock' => 30,
                'image_path' => 'images/products/smartwatch-5.jpg'
            ],
            [
                'name' => 'Tablet Pro',
                'description' => '10.5-inch tablet with 256GB storage and high-resolution display.',
                'price' => 499.99,
                'stock' => 15,
                'image_path' => 'images/products/tablet-pro.jpg'
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
