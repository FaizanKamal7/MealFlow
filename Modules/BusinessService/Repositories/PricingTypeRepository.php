<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\Pricing;
use Modules\BusinessService\Entities\PricingType;
use Modules\BusinessService\Interfaces\PricingTypeInterface;

class PricingTypeRepository implements PricingTypeInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */
    public function getPricingTypes()
    {
        return PricingType::all();
    }

}
