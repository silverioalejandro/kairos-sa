<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'sometimes|required',
            'name' => 'required',
            'description' => 'required',
            'sku' => 'required',
            'category_code' => 'required',
            'price' => 'required',
            'cover_price' => 'required',
            'quantity' => 'required',
            'quantity_factory' => 'required',
            'status_product_code' => 'required',
        ];
    }
}
