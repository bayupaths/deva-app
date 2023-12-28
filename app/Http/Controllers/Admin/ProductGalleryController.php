<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductGallery;

class ProductGalleryController extends Controller
{
    /**
     * uploadGallery
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadGallery(Request $request)
    {
        $request->validate([
            'images.*' => 'required|file|mimes:jpeg,jpg,png,gif|max:2048', // Adjust validation rules as needed
        ]);

        $productId = 1;

        $files = $request->file('file');
        foreach ($files as $file) {
            $path = $file->store('assets/images/product_galleries', 'public');
            // Save to ProductGallery model
            ProductGallery::create([
                'product_id' => $productId,
                'file_name' => $file->getClientOriginalName(),  // Get original file name
                'file_type' => $file->getClientMimeType(),      // Get file type
                'file_size' => $file->getSize(),                // Get file size in bytes
                'file_path' => $path,
                // Add any other fields as needed
            ]);
        }

        return response()->json(['success' => true]);
    }
}
