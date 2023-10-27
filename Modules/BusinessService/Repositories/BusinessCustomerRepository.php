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

    public function create($data)
    {
        return BusinessCustomer::create($data);
    }

    public function getBusinessCustomer($business_id)
    {
        return BusinessCustomer::with('customers')->where(['business_id' => $business_id])->get();
    }
    public function get()
    {
        return BusinessCustomer::all();
    }
    public function getOneBusinessCustomer($id)
    {
        return BusinessCustomer::find($id);
    }

}
