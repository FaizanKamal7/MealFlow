<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\BusinessCustomer;
use Modules\BusinessService\Interfaces\BusinessCustomerInterface;

class BusinessCustomerRepository implements BusinessCustomerInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function create($customer_id, $business_id)
    {

        // Try to find the business customer with the given customer_id and business_id
        // If it does not exist, then create it
        return BusinessCustomer::firstOrCreate([
            'customer_id' => $customer_id,
            'business_id' => $business_id,
        ]);
    }

    public function getBusinessCustomer($business_id)
    {
        return BusinessCustomer::with('customer')->where(['business_id' => $business_id])->get();
    }
}
