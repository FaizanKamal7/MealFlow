<?php

namespace Modules\BusinessService\Interfaces;

interface DeliverySlotPricingInterface
{
    public function get();
    public function create($data);
    public function getBusinessPricing($business_id);
    public function getDeliverySlotPriceOfDelivery($delivery_slot_id, $city_id, $business_id = null);
}
