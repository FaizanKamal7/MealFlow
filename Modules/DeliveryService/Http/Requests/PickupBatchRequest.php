<?php

namespace Modules\DeliveryService\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\DeliveryService\Rules\PickupBatchStatusRule;

class PickupBatchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => ['required', new PickupBatchStatusRule()],
            'map_coordinates' => ['required'],
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
