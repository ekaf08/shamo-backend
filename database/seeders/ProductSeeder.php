<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Data produk contoh
        $products = [
            [
                'categories_id' => 1,
                'name' => 'Nike Air Max 270',
                'price' => 1899000,
                'description' => 'Sepatu sneakers sporty dan nyaman untuk aktivitas sehari-hari.',
                'tags' => 'sneakers, nike, casual',
            ],
            [
                'categories_id' => 2,
                'name' => 'Adidas Ultraboost 22',
                'price' => 2199000,
                'description' => 'Sepatu lari dengan bantalan responsif dan desain modern.',
                'tags' => 'running, adidas, sport',
            ],
            [
                'categories_id' => 3,
                'name' => 'Pantofel Kulit Hitam Pria',
                'price' => 499000,
                'description' => 'Sepatu formal pria berbahan kulit asli.',
                'tags' => 'formal, kulit, pantofel',
            ],
            [
                'categories_id' => 4,
                'name' => 'Timberland Classic Boots',
                'price' => 2599000,
                'description' => 'Boots premium tahan air dengan desain klasik.',
                'tags' => 'boots, timberland, outdoor',
            ],
            [
                'categories_id' => 5,
                'name' => 'Sandal Gunung Eiger',
                'price' => 329000,
                'description' => 'Sandal gunung ringan dan kuat, cocok untuk aktivitas luar ruangan.',
                'tags' => 'sandal, eiger, outdoor',
            ],
            [
                'categories_id' => 6,
                'name' => 'Slip-on Vans Classic',
                'price' => 799000,
                'description' => 'Sepatu slip-on simpel dan stylish.',
                'tags' => 'slipon, vans, casual',
            ],
            [
                'categories_id' => 7,
                'name' => 'High Heels Wanita Elegan',
                'price' => 599000,
                'description' => 'High heels untuk acara formal atau pesta.',
                'tags' => 'heels, wanita, formal',
            ],
            [
                'categories_id' => 8,
                'name' => 'Loafers Pria Kulit Asli',
                'price' => 699000,
                'description' => 'Loafers pria untuk tampilan semi-formal.',
                'tags' => 'loafers, kulit, pria',
            ],
            [
                'categories_id' => 9,
                'name' => 'Wedges Wanita Casual',
                'price' => 549000,
                'description' => 'Wedges nyaman dengan desain kasual untuk wanita.',
                'tags' => 'wedges, wanita, casual',
            ],
            [
                'categories_id' => 10,
                'name' => 'Flat Shoes Wanita Kantor',
                'price' => 449000,
                'description' => 'Flat shoes nyaman untuk kerja atau santai.',
                'tags' => 'flat, wanita, kerja',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'categories_id' => $product['categories_id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'tags' => $product['tags'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
