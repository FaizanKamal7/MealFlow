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
        return Delivery::with('deliverySlot', 'customerAddress')->get();
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
    // public function getDriverDeliveries($driver_id,$start_date,$end_date){
    //     return Delivery::where('d')
    // }
    public function getDeliveriesByStatus($status)
    {
        return Delivery::where('status', $status)->with('deliverySlot', 'customerAddress')->get();
    }

    public function AssignDeliveryBtach($batch_id, $deliveries)
    {
        Delivery::whereIn('id', $deliveries)->update([
            'delivery_batch_id' => $batch_id,
            'status' => 'ASSIGNED',
        ]);
    }

    public function assignPickupBatch($batch_id, $deliveries)
    {
        Delivery::whereIn('id', $deliveries)->update([
            'pickup_batch_id' => $batch_id,
        ]);
    }


    public function getPickupAssignedDeliveries($start_date, $end_date)
    {
        return Delivery::whereNotNull('pickup_batch_id')->get();
    }


    public function getPickupUnassignedDeliveries($start_date, $end_date)
    {
        return Delivery::whereNull('pickup_batch_id')->get();
    }
}
