<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
// use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $categories = [
            'Print Media' => [
                'Brosur', 'Leaflet', 'Poster', 'Flyer', 'Katalog'
            ],
            'Stiker' => [
                'Stiker Vinyl', 'Stiker Cut-out', 'Stiker Transparan', 'Stiker Label'
            ],
            'Kertas Bisnis' => [
                'Kartu Nama', 'Kop Surat', 'Amplop Bisnis', 'Nota'
            ],
            'Merchandise' => [
                'Kaos', 'Mug', 'Gantungan Kunci', 'Tas Kain'
            ],
            'Banner dan Spanduk' => [
                'Banner Roll-up', 'Banner X-stand', 'Spanduk Vinyl', 'Backdrop'
            ],
            'Produk Khusus' => [
                'Kalender', 'Kartu Undangan', 'Buku Yasin', 'Buku Tahunan'
            ],
            'Digital Printing' => [
                'Cetak Foto', 'Cetak Seni', 'Cetak Fotobuku', 'Kaos Digital'
            ],
            'Layanan Desain' => [
                'Desain Grafis', 'Edit Foto'
            ],
            'Jasa Percetakan Custom' => [
                'Cetak Custom', 'Jasa Cutting', 'Finishing Khusus'
            ],
        ];
        $category = $this->faker->randomElement(array_keys($categories));
        $subcategories = $categories[$category];

        $existingCategory = \App\Models\ProductCategory::where('name', $category)->first();

        if ($existingCategory) {
            return $existingCategory->toArray();
        }

        return [
            'name' => $category,
            'slug' => Str::slug($category),
            'description' => $this->faker->paragraph,
            'subcategories' => json_encode($subcategories),
        ];
    }
}
