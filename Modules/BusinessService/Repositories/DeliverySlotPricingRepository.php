<?php

namespace Modules\BusinessService\Repositories;

use Modules\BusinessService\Entities\DeliverySlotPricing;
use Modules\BusinessService\Interfaces\DeliverySlotPricingInterface;

class DeliverySlotPricingRepository implements DeliverySlotPricingInterface
{
    /**
     * @param $departmentName
     * @param $status
     * @return mixed
     */

    public function get()
    {
        return DeliverySlotPricing::all();
    }

    public function create($data)
    {
        $attributes = [
            'city_id' => $data['city_id'],
            'delivery_slot_id' => $data['delivery_slot_id'],
            'business_id' => $data['business_id']
        ];
        DeliverySlotPricing::updateOrCreate($attributes, $data);
    }

    public function getBusinessPricing($business_id)
    {
        return DeliverySlotPricing::where(['business_id' => $business_id])->get();
    }
}
