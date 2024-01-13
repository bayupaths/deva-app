<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductSpecification;


class ProductSpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = \App\Models\Product::inRandomOrder()->first();

        // Contoh data untuk di-seed
        $data = [
            [
                'product_id' =>  3,
                'name' => 'Warna',
                'spec_type' => 'warna',
                'spec_value' => 'Merah',
                'unit' => '',
                'description' => 'Vibrant red color'
            ],
            [
                'product_id' =>  3,
                'spec_type' => 'Printing Technology',
                'spec_value' => 'Digital Printing',
                'unit' => 'Piece',
                'description' => 'High-quality digital printing technology'
            ],
            [
                'product_id' =>  3,
                'spec_type' => 'Material',
                'spec_value' => 'Glossy Paper',
                'unit' => 'Piece',
                'description' => 'Premium glossy paper material'
            ],
            [
                'product_id' =>  3,
                'spec_type' => 'Print Resolution',
                'spec_value' => '1200 DPI',
                'unit' => 'Piece',
                'description' => 'High print resolution for sharp images'
            ],
            [
                'product_id' =>  3,
                'spec_type' => 'Printing Technology',
                'spec_value' => 'Offset Printing',
                'unit' => 'Piece',
                'description' => 'Traditional offset printing method'
            ],
            [
                'product_id' =>  3,
                'spec_type' => 'Paper Type',
                'spec_value' => 'Matte Cardstock',
                'unit' => 'Piece',
                'description' => 'Matte finish cardstock material'
            ],
            [
                'product_id' =>  3,
                'spec_type' => 'Print Color',
                'spec_value' => 'CMYK',
                'unit' => 'Piece',
                'description' => 'Full-color printing with CMYK color mode'
            ],
        ];
         // Masukkan data ke dalam tabel product_specifications
         ProductSpecification::insert($data);
    }
}
