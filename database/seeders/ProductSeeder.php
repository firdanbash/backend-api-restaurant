<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $makanan = Category::where('name', 'Makanan')->first();
        $minuman = Category::where('name', 'Minuman')->first();
        $snack = Category::where('name', 'Snack')->first();
        $dessert = Category::where('name', 'Dessert')->first();

        $products = [
            // Makanan
            [
                'name' => 'Nasi Goreng',
                'sku' => 'MKN-001',
                'price' => 25000,
                'stock' => 50,
                'category_id' => $makanan->id,
                'image' => 'nasi_goreng_1765834284441.jpg',
            ],
            [
                'name' => 'Mie Goreng',
                'sku' => 'MKN-002',
                'price' => 22000,
                'stock' => 45,
                'category_id' => $makanan->id,
                'image' => 'mie_goreng_1765834300956.jpg',
            ],
            [
                'name' => 'Ayam Bakar',
                'sku' => 'MKN-003',
                'price' => 35000,
                'stock' => 30,
                'category_id' => $makanan->id,
                'image' => 'ayam_bakar_1765834315149.jpg',
            ],
            [
                'name' => 'Soto Ayam',
                'sku' => 'MKN-004',
                'price' => 28000,
                'stock' => 40,
                'category_id' => $makanan->id,
                'image' => 'soto_ayam_1765834330304.jpg',
            ],

            // Minuman
            [
                'name' => 'Es Teh Manis',
                'sku' => 'MNM-001',
                'price' => 5000,
                'stock' => 100,
                'category_id' => $minuman->id,
                'image' => 'es_teh_1765834345262.jpg',
            ],
            [
                'name' => 'Jus Jeruk',
                'sku' => 'MNM-002',
                'price' => 12000,
                'stock' => 60,
                'category_id' => $minuman->id,
                'image' => 'jus_jeruk_1765834362042.jpg',
            ],
            [
                'name' => 'Kopi Hitam',
                'sku' => 'MNM-003',
                'price' => 10000,
                'stock' => 80,
                'category_id' => $minuman->id,
                'image' => 'kopi_hitam_1765834378524.jpg',
            ],
            [
                'name' => 'Es Kelapa Muda',
                'sku' => 'MNM-004',
                'price' => 15000,
                'stock' => 50,
                'category_id' => $minuman->id,
                'image' => 'es_kelapa_1765834394784.jpg',
            ],

            // Snack
            [
                'name' => 'French Fries',
                'sku' => 'SNK-001',
                'price' => 15000,
                'stock' => 70,
                'category_id' => $snack->id,
                'image' => 'french_fries_1765834410521.jpg',
            ],

            // Dessert
            [
                'name' => 'Ice Cream',
                'sku' => 'DST-001',
                'price' => 20000,
                'stock' => 50,
                'category_id' => $dessert->id,
                'image' => 'ice_cream_1765834459344.jpg',
            ],
            [
                'name' => 'Pudding',
                'sku' => 'DST-003',
                'price' => 15000,
                'stock' => 40,
                'category_id' => $dessert->id,
                'image' => 'pudding_1765834495526.jpg',
            ],
            [
                'name' => 'Strawberry Cake',
                'sku' => 'DST-004',
                'price' => 18000,
                'stock' => 35,
                'category_id' => $dessert->id,
                'image' => 'strawberry_cake_1765834510546.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
