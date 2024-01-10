<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCategory = \App\Models\ProductCategory::inRandomOrder()->first();
        $faker = Faker::create();

        \App\Models\Product::insert([
            [
                'name' => 'Brosur Premium',
                'slug' => 'brosur-premium',
                'price' => $faker->randomFloat(2, 10, 10000),
                'description' => 'Brosur berkualitas tinggi dengan cetakan digital, cocok untuk promosi acara, produk, atau layanan Anda.',
                'stock' => $faker->numberBetween(0, 100),
                'category_id' => $productCategory->category_id
            ],
            [
                'name' => 'Kartu Nama Elegan',
                'slug' => 'kartu-nama-elegan',
                'price' => $faker->randomFloat(2, 10, 10000),
                'description' => 'Kartu nama dengan desain elegan dan cetakan digital presisi untuk memberikan kesan profesional pada identitas bisnis Anda.',
                'stock' => $faker->numberBetween(0, 100),
                'category_id' => $productCategory->category_id
            ],
            [
                'name' => 'Stiker Vinyl Outdoor',
                'slug' => 'sticker-vinyl-outdoor',
                'price' => $faker->randomFloat(2, 10, 10000),
                'description' => 'Stiker vinyl tahan air dan tahan cuaca dengan cetakan digital, ideal untuk keperluan outdoor seperti kendaraan atau signage.',
                'stock' => $faker->numberBetween(0, 100),
                'category_id' => $productCategory->category_id
            ]
        ]);
    }
}
