<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class PublisherDueDateRequest extends ApiFormRequest
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
            'publisher_id' => 'required'
        ];
    }
}
