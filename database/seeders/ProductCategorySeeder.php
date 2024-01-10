<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ganti jumlah kategori yang diinginkan
        $categories = \App\Models\ProductCategory::factory(5)->create();

        $this->command->info('Product categories seeded!');
    }
}
