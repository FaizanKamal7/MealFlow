<?php

namespace App\Repositories;

use App\Interfaces\DeliverySlotInterface;
use App\Models\DeliverySlot;

class DeliverySlotRepository implements DeliverySlotInterface
{
    public function getAllDeliverySlots()
    {
        return DeliverySlot::all();
    }

    public function addDeliverySlots($start_time, $end_time, $city_id)
    {
        return DeliverySlot::create([
            'start_time' => $start_time,
            'end_time' => $end_time,
            'city_id' => $city_id,
        ]);
    }
}
