<?php

namespace Modules\DeliveryService\Rules;

use App\Enum\BatchStatusEnum;
use Illuminate\Contracts\Validation\Rule;
use Modules\DeliveryService\Entities\PickupBatch;

class BatchStatusRule implements Rule
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
        $allowedBatchStatus = [
            BatchStatusEnum::ASSIGNED->value,
            BatchStatusEnum::STARTED->value,
            BatchStatusEnum::ENDED->value,
        ];
        return in_array($value, $allowedBatchStatus);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Batch Status is not valid (Hint: Try started/ended)';
    }
}
