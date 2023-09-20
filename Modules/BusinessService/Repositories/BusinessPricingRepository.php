<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BusinessPricing;
use Modules\BusinessService\Interfaces\BusinessPricingInterface;

class BusinessPricingRepository implements BusinessPricingInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function create($data)
    {
        return BusinessPricing::create($data);
    }
}
