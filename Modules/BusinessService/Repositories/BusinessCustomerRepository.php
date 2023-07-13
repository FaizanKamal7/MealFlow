<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BusinessCustomer;

class BusinessCustomerRepository implements BusinessCustomerInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function createBusinessCustomer($name, $status = "active")
    {
        $businessCategory = new BusinessCustomer([
            "name" => $name,
            "status" => $status,
        ]);
        $businessCategory->save();
        return $businessCategory;
    }

    public function getBusinessCustomer()
    {
        return BusinessCustomer::all();
    }
}
