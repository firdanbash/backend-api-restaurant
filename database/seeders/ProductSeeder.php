<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Makanan (category_id: 1)
            ['sku' => 'MKN001', 'name' => 'Nasi Goreng', 'stock' => 50, 'price' => 25000, 'image' => 'nasi-goreng.jpg', 'category_id' => 1],
            ['sku' => 'MKN002', 'name' => 'Mie Goreng', 'stock' => 50, 'price' => 20000, 'image' => 'mie-goreng.jpg', 'category_id' => 1],
            ['sku' => 'MKN003', 'name' => 'Ayam Goreng', 'stock' => 30, 'price' => 30000, 'image' => 'ayam-goreng.jpg', 'category_id' => 1],
            ['sku' => 'MKN004', 'name' => 'Soto Ayam', 'stock' => 40, 'price' => 22000, 'image' => 'soto-ayam.jpg', 'category_id' => 1],
            ['sku' => 'MKN005', 'name' => 'Gado-Gado', 'stock' => 35, 'price' => 18000, 'image' => 'gado-gado.jpg', 'category_id' => 1],

            // Minuman (category_id: 2)
            ['sku' => 'MNM001', 'name' => 'Es Teh', 'stock' => 100, 'price' => 5000, 'image' => 'es-teh.jpg', 'category_id' => 2],
            ['sku' => 'MNM002', 'name' => 'Es Jeruk', 'stock' => 80, 'price' => 8000, 'image' => 'es-jeruk.jpg', 'category_id' => 2],
            ['sku' => 'MNM003', 'name' => 'Es Kelapa', 'stock' => 60, 'price' => 10000, 'image' => 'es-kelapa.jpg', 'category_id' => 2],
            ['sku' => 'MNM004', 'name' => 'Jus Alpukat', 'stock' => 50, 'price' => 15000, 'image' => 'jus-alpukat.jpg', 'category_id' => 2],
            ['sku' => 'MNM005', 'name' => 'Kopi Hitam', 'stock' => 70, 'price' => 7000, 'image' => 'kopi-hitam.jpg', 'category_id' => 2],

            // Snack (category_id: 3)
            ['sku' => 'SNK001', 'name' => 'Kentang Goreng', 'stock' => 60, 'price' => 12000, 'image' => 'kentang-goreng.jpg', 'category_id' => 3],
            ['sku' => 'SNK002', 'name' => 'Pisang Goreng', 'stock' => 50, 'price' => 10000, 'image' => 'pisang-goreng.jpg', 'category_id' => 3],
            ['sku' => 'SNK003', 'name' => 'Tahu Isi', 'stock' => 45, 'price' => 8000, 'image' => 'tahu-isi.jpg', 'category_id' => 3],

            // Dessert (category_id: 4)
            ['sku' => 'DST001', 'name' => 'Es Krim Vanilla', 'stock' => 40, 'price' => 15000, 'image' => 'es-krim-vanilla.jpg', 'category_id' => 4],
            ['sku' => 'DST002', 'name' => 'Puding Coklat', 'stock' => 35, 'price' => 12000, 'image' => 'puding-coklat.jpg', 'category_id' => 4],
            ['sku' => 'DST003', 'name' => 'Cake Strawberry', 'stock' => 25, 'price' => 20000, 'image' => 'cake-strawberry.jpg', 'category_id' => 4],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
