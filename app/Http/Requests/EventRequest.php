<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'customer_id' => 'required',
            'address' => 'required',
            'event_start' => 'required',
            'event_end' => 'required',
            'event_date' => 'required',
            'code' => 'required',
            'status_event_code' => 'required',
        ];
    }
}
