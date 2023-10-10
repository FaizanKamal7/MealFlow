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

    public function getDeliverySlotPriceOfDelivery($delivery_slot_id, $city_id, $business_id = null)
    {
        $delivery_slot_pricing = null;

        if ($business_id !== null) {
            $delivery_slot_pricing = DeliverySlotPricing::where('delivery_slot_id', '=', $delivery_slot_id)
                ->where('city_id', '=', $city_id)->where('business_id', '=', $business_id)->orderBy('created_at', 'desc')->first();
        }

        if ($delivery_slot_pricing == null || $business_id == null) {
            $delivery_slot_pricing = DeliverySlotPricing::where('delivery_slot_id', '=', $delivery_slot_id)
                ->where('city_id', '=', $city_id)->orderBy('created_at', 'desc')->first();
        }

        return $delivery_slot_pricing;
    }
}
