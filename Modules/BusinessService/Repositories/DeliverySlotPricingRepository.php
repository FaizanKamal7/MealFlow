<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BusinessUser;
use Modules\BusinessService\Entities\DeliverySlotPricing;
use Modules\BusinessService\Interfaces\BusinessUserInterface;
use Modules\BusinessService\Interfaces\DeliverySlotPricingInterface;

class DeliverySlotPricingRepository implements DeliverySlotPricingInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function get()
    {
        return DeliverySlotPricing::all();
    }

    public function create($data)
    {
        return DeliverySlotPricing::create($data);
    }
}
