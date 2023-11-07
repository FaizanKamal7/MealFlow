<?php

namespace Modules\BusinessService\Interfaces;

interface BusinessCustomerInterface
{
    public function create($customer_id, $business_id);
    public function getBusinessCustomer($business_id);
    public function get();
    public function getOneBusinessCustomer($id);


}
