<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categoryId = Category::pluck('id')->toArray();

        if (empty($categoryId)) {
            echo "Tidak ada data kategori";
            return;
        }

        $getRandomCateogryId = function () use ($categoryId) {
            return $categoryId[array_rand($categoryId)];
        };

        $product = [
            [
                'sku' => 'MNM001',
                'name' => 'Kopi Robusta Premium 500gr',
                'stock' => 150,
                'price' => 75000,
                'image' => 'https://via.placeholder.com/640x480?text=Kopi',
            ],
            [
                'sku' => 'MKN002',
                'name' => 'Mie Instan Goreng Spesial (Pack)',
                'stock' => 1000,
                'price' => 35000,
                'image' => 'https://via.placeholder.com/640x480?text=Mie',
            ],
            [
                'sku' => 'MKN003',
                'name' => 'Kerupuk Ikan Pedas',
                'stock' => 300,
                'price' => 15000,
                'image' => 'https://via.placeholder.com/640x480?text=Kerupuk',
            ],
            [
                'sku' => 'MNM004',
                'name' => 'Teh Celup Hijau Organik',
                'stock' => 250,
                'price' => 45000,
                'image' => 'https://via.placeholder.com/640x480?text=Teh',
            ],
        ];

        foreach ($product as $data) {
            Product::create(array_merge($data, [
                'category_id' => $getRandomCateogryId(),
            ]));
        }
    }
}
