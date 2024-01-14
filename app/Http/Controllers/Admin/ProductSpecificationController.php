<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;

class ProductSpecificationController extends Controller
{
    public function index($id)
    {
        $specProduct = ProductSpecification::with(['product'])
            ->whereHas('product', function ($query) use ($id) {
                $query->where('product_id', $id);
            })->get();

            // dd($specProduct);
        return view('pages.admin.products.index-spec', [
            'specs' => $specProduct
        ]);
    }

    public function create()
    {

        return view('pages.admin.products.create-spec');
    }

    public function show()
    {
    }

    public function store(Request $request)
    {
    }
}
