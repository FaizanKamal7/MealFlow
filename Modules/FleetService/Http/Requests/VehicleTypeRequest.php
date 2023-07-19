<?php

namespace Modules\FleetService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vehicle_type'=>['required','unique:vehicle_types,name'],
            'vehicle_capacity'=>['required'],
            'vehicle_icon'=>['required'],
            'updated_type_name'=>['required','unique:vehicle_types,name'],
            
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
