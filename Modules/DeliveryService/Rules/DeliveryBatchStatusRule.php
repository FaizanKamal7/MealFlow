<?php

namespace Modules\DeliveryService\Rules;

use App\Enum\DeliveryBatchStatusEnum;
use Illuminate\Contracts\Validation\Rule;

class DeliveryBatchStatusRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $allowedPickupBatchStatus = [
            DeliveryBatchStatusEnum::ASSIGNED->value,
            DeliveryBatchStatusEnum::STARTED->value,
            DeliveryBatchStatusEnum::ENDED->value,
        ];
        return in_array($value, $allowedPickupBatchStatus);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Delivery Batch Status is not valid (Hint: Try started/ended)';
    }
}
