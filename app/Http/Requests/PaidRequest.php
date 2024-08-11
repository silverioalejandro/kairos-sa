<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaidRequest extends FormRequest
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
            'budget_id'=> 'required',
            'payment_type_code'=> 'required',
            'amount'=> 'required',
            'payment_date'=> 'required',
            'obs'=> 'required',
        ];
    }
}
