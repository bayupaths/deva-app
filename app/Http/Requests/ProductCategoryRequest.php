<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|unique:product_categories|max:255',
            // 'description' => 'required|max:500',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        // Jika sedang dalam proses 'update', tambahkan pengecualian untuk kategori saat ini
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['name'] .= ',' . $this->route('category.update');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada, pilih nama lain.',
            'name.max' => 'Nama kategori tidak boleh melebihi 255 karakter.',
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah digunakan. Pilih nama lain.',
            // 'description.required' => 'Deskripsi kategori wajib diisi.',
            // 'description.max' => 'Deskripsi kategori tidak boleh melebihi 500 karakter.',
            // 'image.required' => 'Gambar kategori wajib diunggah.',
            // 'image.image' => 'File harus berupa gambar.',
            // 'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            // 'image.max' => 'Ukuran gambar tidak boleh melebihi 2 MB.',
        ];
    }
}
