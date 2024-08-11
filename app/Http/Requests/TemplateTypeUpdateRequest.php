<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TemplateTypeUpdateRequest extends FormRequest
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
            'id' => 'required',
            'name' => [
				'required',
				Rule::unique('template_types')
					->ignore($this->id)
                    ->where('name', $this->name)
			],
            'dictionary' => 'required',
            'type_id' => 'required'
        ];
    }
}
