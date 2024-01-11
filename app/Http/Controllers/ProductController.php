<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman produk
     *
     * @return void
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = ProductCategory::all();

        $productsQuery = Product::with([
            'productCategory', 'productGallery', 'productSpecification'
        ])->paginate(12);

        if ($search) {
            $productsQuery = Product::with([
                'productCategory', 'productGallery', 'productSpecification'
            ])->where(function ($queryBuilder) use ($search) {
                $queryBuilder->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })->paginate(12);
        }

        $products = $productsQuery;
        return view('pages.customers.product', [
            'categories' => $categories,
            'products' => $products,
            'search' => $search,
        ]);
    }

    /**
     * productsByCategory
     *
     * @param  String $slug
     * @return void
     */
    public function productsByCategory(String $slug)
    {
        $categories = ProductCategory::all();

        $products = Product::with([
            'productCategory', 'productGallery', 'productSpecification'
        ])->whereHas('productCategory', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->paginate(12);

        return view('pages.customers.product', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * Menampilkan detail dari produk yang dipilih
     *
     * @param  String $slug
     * @return void
     */
    public function productDetail(String $slug)
    {
        $product = Product::with([
            'productCategory', 'productGallery' => function ($query) {
                $query->take(5);
            }, 'productSpecification'
        ])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with(['productGallery'])
            ->where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->inRandomOrder()->limit(4)->get();

        return view('pages.customers.product-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}
