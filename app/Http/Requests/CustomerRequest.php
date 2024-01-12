<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        $userId = $this->route('customer');
        $rules =  [
            'name' => 'required|string|max:255|min:5',
            'phone_number' => 'max:15',
            // 'address' => 'string',
            'password' => 'required|string|min:8'
        ];

        // Jika sedang dalam proses 'update', tambahkan pengecualian untuk email saat ini
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['email'] = [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')
                    ->where(function ($query) use ($userId) {
                        $query->where('user_id', '<>', $userId);
                    })
            ];
            $rules['password'] = 'string|min:8';
        } else {
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama konsumen harus diisi.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus valid.',
            'email.unique' => 'Email sudah terdaftar pada sistem, gunakan email lain.',
            // 'phone_number.string' => 'Kolom nomor telepon harus berupa teks.',
            'phone_number.max' => 'Panjang nomor telepon tidak boleh lebih dari :max karakter.',
            // 'address.string' => 'Kolom alamat harus berupa teks.',
            'password.required' => 'Kolom password harus diisi.',
            'password.string' => 'Kolom password harus berupa teks.',
            'password.min' => 'Panjang password minimal :min karakter.',
        ];
    }
}
