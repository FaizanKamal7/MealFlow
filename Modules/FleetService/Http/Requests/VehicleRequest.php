<?php

namespace Modules\FleetService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'registration_number' => ['required', 'unique:vehicles'],
            'engine_number' => ['required', 'unique:vehicles'],
            'chassis_number' => ['required', 'unique:vehicles'],
            // 'vehicle_make' => ['required', 'string'],
            'vehicle_model' => ['required', 'string'],
            'vehicle_color' => ['nullable', 'string'],
            'vehicle_status' => ['required'],
            'vehicle_type' => ['required'],
            'vehicle_picture' => ['nullable', 'image'],
            'vehicle_mileage' => ['nullable', 'integer'],
            'registration_picture' => ['nullable', 'image'],
            'registration_issue_date' => ['nullable', 'date'],
            'registration_expiry_date' => ['nullable', 'date','after:registration_issue_date'],
            'insurance_picture' => ['nullable', 'image'],
            'insurance_issue_date' => ['nullable', 'date'],
            'insurance_expiry_date' => ['nullable', 'date','after:insurance_issue_date'],
            'municipality_picture' => ['nullable', 'image'],
            'municipality_issue_date' => ['nullable', 'date'],
            'municipality_expiry_date' => ['nullable', 'date','after:municipality_issue_date'],
            'api_unit_id' => ['nullable', 'numeric'],
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

    public function messages(): array
    {
        return [
            // 'registration_number.unique' => 'Registration number is already link with another vehicle',
        ];
    }
}