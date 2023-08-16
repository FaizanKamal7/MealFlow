<?php

namespace Modules\BusinessService\Interfaces;

interface DeliverySlotPricingInterface
{
    public function get();
    public function create($data);
}
