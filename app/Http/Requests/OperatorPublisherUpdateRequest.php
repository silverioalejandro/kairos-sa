<?php

namespace App\Http\Requests;

use App\Models\Operator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OperatorPublisherUpdateRequest extends FormRequest
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
            'operator_id' => 'required',
            'name' => 'required',
            'company' => 'required',
            'domain_id' => 'required',
            'email' => [
				'required',
				Rule::unique('operators')
					->ignore($this->operator_id)
                    ->where('email', $this->email)
			],
            'pay' => 'required'
        ];
    }
}
