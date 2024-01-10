<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return [
            'product_id' => 'required|exists:products,',
            'order_note' => 'nullable|string|max:255',
            'total_price' => 'required|numeric|min:0',
            'product_price' => 'required|numeric|min:0',
            'product_quantity' =>  'required|integer|min:1',
            'product_note' => 'nullable|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:255'
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [

        ];
    }
}
