<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('productCategory')->get();
        return view('pages.admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('pages.admin.products.create-new', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|exists:product_categories,category_id',
            'name' => 'required|max:255|min:5|string|unique:products,name',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0'
        ], [
            'category.required' => 'Kolom kategori produk harus diisi.',
            'category.exists' => 'Pilihan kategori produk tidak valid.',
            'name.required' => 'Kolom nama produk harus diisi.',
            'name.max' => 'Kolom nama produk tidak boleh lebih dari :max karakter.',
            'name.min' => 'Kolom nama produk tidak boleh kurang dari :min karakter.',
            'name.string' => 'Kolom nama produk harus berupa teks.',
            'name.unique' => 'Kolom nama produk sudah digunakan, masukan nama lainnya.',
            'price.required' => 'Kolom harga produk harus diisi.',
            'price.numeric' => 'Kolom harga produk harus berupa angka.',
            'price.min' => 'Kolom harga produk tidak boleh kurang dari :min karakter.',
            'description.required' => 'Kolom deskripsi produk tidak boleh kosong.',
            'description.required' => 'Kolom deskripsi produk produk harus berupa teks.',
            'stock.required' => 'Kolom stok produk harus diisi.',
            'stock.integer' => 'Kolom stok produ harus berupa bilangan bulat.',
            'stock.min' => 'Kolom stok produk tidak boleh kurang dari :min karakter.',
        ]);

        // Conditions if validation is fails
        if ($validator->fails()) {
            return redirect()->route('product.create')->withErrors($validator)->withInput();
        }
        // Rule is validated
        $validated = $validator->validated();

        // dd($validated);
        // Prepare to save
        $data = $validated;
        // make unique slug title
        $data['slug'] = Str::slug($validated['name']);
        $data['category_id'] = $validated['category'];
        $save = Product::create($data);

        $request->validate([
            'images.*' => 'required|file|mimes:jpeg,jpg,png,gif|max:2048', // Adjust validation rules as needed
        ]);


        $files = $request->file('images');
        foreach ($files as $file) {
            $path = $file->store('assets/images/product_galleries', 'public');
            // Save to ProductGallery model
            ProductGallery::create([
                'product_id' => $save->id,
                'file_name' => $file->getClientOriginalName(),  // Get original file name
                'file_type' => $file->getClientMimeType(),      // Get file type
                'file_size' => $file->getSize(),                // Get file size in bytes
                'file_path' => $path,
                // Add any other fields as needed
            ]);
        }


        if ($save) {
            return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan');
        } else {
            return redirect()->route('product.create')->with('errors', 'Produk gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.admin.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.admin.products.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
