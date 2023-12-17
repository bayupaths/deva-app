<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\ProductGallery;

class ProductGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Jumlah gambar yang ingin di-generate
        $numberOfImages = 5;
        $product = \App\Models\Product::inRandomOrder()->first();

        for ($i = 1; $i <= $numberOfImages; $i++) {
            // Mengambil gambar acak dari Unsplash
            $response = Http::get('https://source.unsplash.com/random/800x800');
            $imageData = $response->getBody();

            $imageName = "product_gallery_$i.jpg";
            $imagePath = "public/assets/images/product_galleries/$imageName";

            file_put_contents(storage_path("app/$imagePath"), $imageData);

            // Simpan data ke dalam tabel product_galleries
            ProductGallery::create([
                'product_id'   => $product->product_id,
                'file_name'    => $imageName,
                'file_type'    => 'image/jpeg', // Sesuaikan dengan tipe file yang sesuai
                'file_size'    => strlen($imageData),
                'file_path'    => $imagePath,
                'description'  => "Description for image $i",
            ]);
        }
    }
}
