<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Pro X',
                'description' => 'High-performance laptop with 16GB RAM, 512GB SSD, and 15-inch display.',
                'price' => 1299.99,
                'stock' => 25,
                'image_path' => 'images/products/laptop.jpg'
            ],
            [
                'name' => 'Laptop UltraBook',
                'description' => 'Slim and lightweight laptop with 8GB RAM, 256GB SSD, and 13-inch display.',
                'price' => 899.99,
                'stock' => 30,
                'image_path' => 'images/products/laptop.jpg'
            ],
            [
                'name' => 'Laptop Gaming Pro',
                'description' => 'Powerful gaming laptop with RTX 3080, 32GB RAM, and 17-inch display.',
                'price' => 1899.99,
                'stock' => 15,
                'image_path' => 'images/products/laptop.jpg'
            ],
            [
                'name' => 'Laptop Business Elite',
                'description' => 'Business laptop with enhanced security features, 16GB RAM, and 14-inch display.',
                'price' => 1199.99,
                'stock' => 20,
                'image_path' => 'images/products/laptop.jpg'
            ],
            [
                'name' => 'Laptop Creator Max',
                'description' => 'Laptop designed for content creators with color-accurate 15-inch display and 32GB RAM.',
                'price' => 1599.99,
                'stock' => 10,
                'image_path' => 'images/products/laptop.jpg'
            ],
            [
                'name' => 'Laptop Budget',
                'description' => 'Affordable laptop with 4GB RAM, 128GB storage, and 15-inch display.',
                'price' => 499.99,
                'stock' => 40,
                'image_path' => 'images/products/laptop.jpg'
            ],
            [
                'name' => 'Telefoon Ultra',
                'description' => 'Latest smartphone with 128GB storage, 6.7-inch OLED display, and 48MP camera.',
                'price' => 899.99,
                'stock' => 50,
                'image_path' => 'images/products/telefoon.jpg'
            ],
            [
                'name' => 'Telefoon Mini',
                'description' => 'Compact smartphone with 5.4-inch display, 64GB storage, and excellent camera.',
                'price' => 699.99,
                'stock' => 35,
                'image_path' => 'images/products/telefoon.jpg'
            ],
            [
                'name' => 'Telefoon Pro Max',
                'description' => 'Premium smartphone with 6.9-inch display, 256GB storage, and pro-grade camera system.',
                'price' => 1099.99,
                'stock' => 25,
                'image_path' => 'images/products/telefoon.jpg'
            ],
            [
                'name' => 'Telefoon Budget',
                'description' => 'Affordable smartphone with 6.1-inch LCD display and 48MP camera.',
                'price' => 299.99,
                'stock' => 60,
                'image_path' => 'images/products/telefoon.jpg'
            ],
            [
                'name' => 'Telefoon Fold',
                'description' => 'Foldable smartphone with innovative dual-screen design and 512GB storage.',
                'price' => 1499.99,
                'stock' => 15,
                'image_path' => 'images/products/telefoon.jpg'
            ],
            [
                'name' => 'Tablet Pro',
                'description' => '10.5-inch tablet with 256GB storage and high-resolution display.',
                'price' => 499.99,
                'stock' => 15,
                'image_path' => 'images/products/tablet.jpg'
            ],
            [
                'name' => 'Tablet Mini',
                'description' => '8.3-inch compact tablet with A15 chip and 128GB storage.',
                'price' => 399.99,
                'stock' => 25,
                'image_path' => 'images/products/tablet.jpg'
            ],
            [
                'name' => 'Tablet Air',
                'description' => 'Ultra-thin tablet with 10.9-inch Liquid Retina display and 64GB storage.',
                'price' => 599.99,
                'stock' => 20,
                'image_path' => 'images/products/tablet.jpg'
            ],
            [
                'name' => 'Tablet Kids',
                'description' => 'Kid-friendly tablet with parental controls, protective case, and 32GB storage.',
                'price' => 199.99,
                'stock' => 30,
                'image_path' => 'images/products/tablet.jpg'
            ],
            [
                'name' => 'Tablet Pro Max',
                'description' => 'Premium 12.9-inch tablet with M2 chip, 512GB storage, and Liquid Retina XDR display.',
                'price' => 1099.99,
                'stock' => 10,
                'image_path' => 'images/products/tablet.jpg'
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
