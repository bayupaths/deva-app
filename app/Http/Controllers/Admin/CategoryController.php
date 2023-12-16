<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Models\ProductCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('pages.admin.categories.index', [
            'categories' =>  $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // set validate product category
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_categories|max:255',
            // 'description' => 'required|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada, pilih nama lain.',
            'name.max' => 'Nama kategori tidak boleh melebihi 255 karakter.',
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah digunakan. Pilih nama lain.',
            // 'description.required' => 'Deskripsi kategori wajib diisi.',
            // 'description.max' => 'Deskripsi kategori tidak boleh melebihi 500 karakter.',
            'image.required' => 'Gambar kategori wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh melebihi 2 MB.',
        ]);

        // Conditions if validation is fails
        if ($validator->fails()) {
            return redirect()->route('category.create')->withErrors($validator)->withInput();
        }

        // Rule is validated
        $validated = $validator->validated();
        // Prepare to save
        $data = $validated;
        // make unique slug title
        $data['slug'] = Str::slug($validated['name']);
        $data['image'] = $request->file('image')->store('assets/images/category', 'public');
        $save = ProductCategory::create($data);
        if ($save) {
            return redirect()->route('category.index')->with('success', 'Kategori produk berhasil ditambahkan');
        } else {
            return redirect()->route('category.create')->with('errors', 'Kategori produk gagal ditambahkan');
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
        return view('pages.admin.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        return view('pages.admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $category)
    {
        // set validate product category
        $validator = Validator::make($request->all(), [
            'name' => [
                'required', 'max:255',
                Rule::unique('product_categories', 'name')
                    ->where(function ($query) use ($category) {
                        $query->where('category_id', '<>', $category->category_id);
                    })
            ],
            // 'description' => 'required|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada, pilih nama lain.',
            'name.max' => 'Nama kategori tidak boleh melebihi 255 karakter.',
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah digunakan. Pilih nama lain.',
            // 'description.required' => 'Deskripsi kategori wajib diisi.',
            // 'description.max' => 'Deskripsi kategori tidak boleh melebihi 500 karakter.',
            'image.required' => 'Gambar kategori wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh melebihi 2 MB.',
        ]);

        // Conditions if validation is fails
        if ($validator->fails()) {
            return redirect()->route('category.edit', $category->slug)->withErrors($validator)->withInput();
        }

        // Rule is validated
        $validated = $validator->validated();
        // Prepare to save
        $data = $validated;
        // check image is uploaded
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('assets/images/category', 'public');
        }

        $data['slug'] = Str::slug($validated['name']);
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'Kategori produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductCategory::findOrFail($id);
        $item->delete();
        return redirect()->route('category.index')->with('success', 'Kategori produk berhasil dihapus');
    }
}
