<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\Delivery;
use Modules\DeliveryService\Interfaces\DeliveryInterface;

class DeliveryRepository implements DeliveryInterface
{
    public function create($data)
    {
        return Delivery::create($data);
    }

    public function get()
    {
        return Delivery::get();
    }

    public function getWithFilters(...$parameters)
    {
        $start_date = $parameters[0] ?? null;
        $end_date = $parameters[1] ?? null;
        $partner_id = $parameters[2] ?? null;
        $city_id = $parameters[3] ?? null;
        $delivery_slot_id = $parameters[4] ?? null;

        if ($start_date == null || $end_date == null) {
            return Delivery::get();
        } else {
            return Delivery::where('delivery_date', [$start_date, $end_date]);
        }
    }
}
