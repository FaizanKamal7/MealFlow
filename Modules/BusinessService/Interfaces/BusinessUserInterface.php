<?php

namespace Modules\BusinessService\Interfaces;

interface BusinessUserInterface
{
    public function createBusinessUser($user_id, $business_id);
    public function get();
    public function getBusinessUser($user_id);
}
