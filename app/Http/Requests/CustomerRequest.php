<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
			'email' => 'required',
			'cellphone' => 'required',
			'address' => 'required',
			'province' => 'required',
			'neighborhood' => 'required',
			'identification_number' => 'required',
			'status_customer_code' => 'required',
        ];
    }
}
