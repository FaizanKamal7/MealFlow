<?php

namespace Modules\BusinessService\Interfaces;

interface CustomerSecondaryNumberInterface
{
    public function get();
    public function getCustomerPhoneNumbers($cust_id);
}
