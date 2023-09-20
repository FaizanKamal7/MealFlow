<?php

namespace Modules\BusinessService\Interfaces;

interface BusinessCustomerInterface
{
    public function create($data);
    public function getBusinessCustomer($business_id);
}
