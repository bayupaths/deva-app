<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;
use App\Http\Requests\ProductSpecificationRequest;
use Illuminate\Support\Str;

class ProductSpecificationController extends Controller
{

    public function index()
    {


    }

    public function getSpecProduct($uuid)
    {
        $product = Product::with(['specifications'])
        ->where('uuid', $uuid)->firstOr();
        return view('pages.admin.products.index-spec', [
            'product' => $product,
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
        $validator = $this->validate($request, [
            'name' => 'required|string|max:255',
            'spec_value' => 'required|string|max:255',
            'unit' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
        ]);

        $data = $validator;
        $data['spec_type'] = Str::slug($validator['name'], '_');
        $spec = ProductSpecification::create($data);
        return redirect()->route('product.specs', $spec->products->uuid);
    }

    public function getSpecificationName($specType)
    {
        try {
            $specification = ProductSpecification::where('spec_type', $specType)->first();
            if ($specification) {
                $name = $specification->name;
                return response()->json(['name' => $name]);
            } else {
                return response()->json(['error' => 'Data not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
