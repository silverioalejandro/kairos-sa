<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'freight_id' => 'required',
            'vehicle_type_id' => 'required',
            'patent' => 'required',
            'obs' => 'required',
            'price' => 'required',
            'status_vehicle_code' => 'required',
        ];
    }
}
