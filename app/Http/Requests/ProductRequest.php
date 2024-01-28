<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'category' => 'required|exists:product_categories,id',
            'name' => 'required|max:255|min:5|string|unique:products,name',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'integer|min:0'
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['name'] = [
                'required', 'max:255', 'min:5',
                Rule::unique('products', 'name')
                    ->where(function ($query) {
                        $query->where('product_id', '<>', $this->route('product'));
                    })
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
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
            'stock.integer' => 'Kolom stok produk harus berupa bilangan bulat.',
            'stock.min' => 'Kolom stok produk tidak boleh kurang dari :min karakter.',
        ];
    }
}
