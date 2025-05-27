<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            'Sneakers',
            'Running Shoes',
            'Formal Shoes',
            'Boots',
            'Sandals',
            'Slip-ons',
            'High Heels',
            'Loafers',
            'Wedges',
            'Flat Shoes',
            'Sports Shoes',
            'Safety Shoes',
        ];

        foreach ($categories as $category) {
            DB::table('product_categories')->insert([
                'name' => $category,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
