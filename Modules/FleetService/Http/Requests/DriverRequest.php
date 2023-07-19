<?php

namespace Modules\FleetService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Employee1' => ['required', 'unique:drivers,employee_id'],
            'license_number' => ['required', 'string', 'max:255'],
            'license_Document' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'], 
            'license_issue_Date' => ['required', 'date'],
            'license_expiry_Date' => ['required', 'date', 'after:license_issue_Date'],
            'driver_areas' => ['required', 'array'], 
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
    /**
     * Summary of messages
     * @return array
     */
    public function messages():array{
        return [
            'Employee1.unique' => 'Employee is already link with another Driver',
        ];
    }
}
