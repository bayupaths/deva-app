<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductGalleryController extends Controller
{

    public function index($uuid)
    {
        $product = Product::with(['galleries', 'categories'])
            ->where('uuid', $uuid)->firstOr();
        return view('pages.admin.products.product-galleries', [
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        $uuid = $request->input('product_uuid');
        $product_id = $request->input('product_id');
        $fileName = $request->input('file_name');
        $fileType = $request->input('file_type');
        $fileSize = $request->input('file_size');
        $filePath = $request->input('file_path');

        foreach ($fileName as $index => $file) {
            ProductGallery::create([
                'product_id' => $product_id,
                'file_name' => $file,
                'file_type' => $fileType[$index],
                'file_size' => $fileSize[$index],
                'file_path' => $filePath[$index],
            ]);
        }

        return redirect()->route('product.galleries', $uuid);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $file_type = $file->getClientOriginalExtension();
        $file_size = $file->getSize() / 1024; // in KB
        $file_path = $file->store('assets/images/product_galleries', 'public');

        return response()->json([
            'file_name' => $file_name,
            'file_type' => $file_type,
            'file_size' => $file_size,
            'file_path' => $file_path,
            // 'upload' => $upload,
            'status' => true
        ]);
    }

    public function destroy($id)
    {
        try {
            $image = ProductGallery::findOrFail($id);
            if (Storage::disk('public')->exists($image->file_path)) {
                Storage::disk('public')->delete($image->file_path);
            }
            $image->delete();
            return response()->json(['message' => 'Foto berhasil dihapus']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Foto tidak ditemukan', 'message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus foto', 'message' => $e->getMessage()], 500);
        }
    }
}
