<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\Customer;
use Modules\BusinessService\Entities\CustomerSecondaryNumber;
use Modules\BusinessService\Interfaces\CustomerSecondaryNumberInterface;

class CustomerSecondaryNumberRepository implements CustomerSecondaryNumberInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function get()
    {
        return CustomerSecondaryNumber::get();
    }

    public function getCustomerPhoneNumbers($cust_id)
    {
        return CustomerSecondaryNumber::where(['customer_id' => $cust_id])->get();
    }

   



}
