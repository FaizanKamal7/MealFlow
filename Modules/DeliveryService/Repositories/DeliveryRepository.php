<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\Delivery;
use Modules\DeliveryService\Entities\PickupBatch;
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

    public function getDeliveriesByIds(array $deliveryIds)
    {
        // Retrieve the deliveries by their IDs
        return Delivery::whereIn('id', $deliveryIds)->get();
    }

    public function updateDelivery($delivery_id, $data)
    {
        $delivery = Delivery::findOrFail($delivery_id);
        // $delivery->fill($data);
        // return $delivery->save();
        return $delivery->update($data);
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

    public function assignDeliveryBatch($batch_id, $deliveries)
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

    public function getDriverPickupAssignedDeliveries($start_date, $end_date, $batch_id)
    {
        return Delivery::where('pickup_batch_id', $batch_id)->whereBetween('delivery_date', [$start_date, $end_date])->get();
    }


    public function getPickupUnassignedDeliveries($start_date, $end_date)
    {
        return Delivery::whereNull('pickup_batch_id')->get();
    }

    public function updateDeliveryQR($delivery_id, $data)
    {
        return  Delivery::where('id', $delivery_id)->whereNull('qr_code')->update($data);
    }



    public function getDriverPendingPickups($driver_id, $batch_id)
    {
        // $deliveries = Delivery::with([
        //     'pickupBatch' => function ($query) use ($driver_id, $batch_id) {
        //         $query->where('driver_id', '=', $driver_id);
        //         $query->where('id', '=', $batch_id);
        //     },
        //     'deliveryBags'
        // ])
        //     ->get();


        return Delivery::select('deliveries.id', 'deliveries.customer_id', 'deliveries.branch_id', 'deliveries.pickup_batch_id')->with([
            'customer' => function ($query) {
                $query->select('id', 'user_id');
            },
            'customer.user' => function ($query) {
                $query->select('id', 'name');
            },
            'branch' => function ($query) {
                $query->select('id', 'name');
            },

        ])
            ->join('pickup_batches', 'deliveries.pickup_batch_id', '=', 'pickup_batches.id')
            ->leftJoin('delivery_bags', 'deliveries.id', '=', 'delivery_bags.delivery_id')
            ->where('deliveries.pickup_batch_id', '=', $batch_id)
            ->where('pickup_batches.driver_id', '=', $driver_id)
            ->whereNull('delivery_bags.delivery_id')
            ->get();
    }

    public function getDriverPendingBranchPickups($driver_id, $batch_id, $branch_id)
    {
        // $deliveries = Delivery::with([
        //     'pickupBatch' => function ($query) use ($driver_id, $batch_id) {
        //         $query->where('driver_id', '=', $driver_id);
        //         $query->where('id', '=', $batch_id);
        //     },
        //     'deliveryBags'
        // ])
        //     ->get();


        return Delivery::select('deliveries.id', 'deliveries.customer_id', 'deliveries.branch_id', 'deliveries.pickup_batch_id')->with([
            'customer' => function ($query) {
                $query->select('id', 'user_id');
            },
            'customer.user' => function ($query) {
                $query->select('id', 'name');
            },
            'branch' => function ($query) {
                $query->select('id', 'name');
            },

        ])
            ->join('pickup_batches', 'deliveries.pickup_batch_id', '=', 'pickup_batches.id')
            ->leftJoin('delivery_bags', 'deliveries.id', '=', 'delivery_bags.delivery_id')
            ->where('deliveries.pickup_batch_id', '=', $batch_id)
            ->where('pickup_batches.driver_id', '=', $driver_id)
            ->where('deliveries.branch_id', '=', $branch_id)
            ->whereNull('delivery_bags.delivery_id')
            ->get();
    }

    public function getDriverCompletedPickups($driver_id, $batch_id)
    {

        return Delivery::select('deliveries.id', 'deliveries.customer_id', 'deliveries.branch_id', 'delivery_bags.bag_id')->with([
            'customer' => function ($query) {
                $query->select('id', 'user_id');
            },
            'customer.user' => function ($query) {
                $query->select('id', 'name');
            },
            'branch' => function ($query) {
                $query->select('id', 'name');
            },

        ])
            ->join('pickup_batches', 'deliveries.pickup_batch_id', '=', 'pickup_batches.id')
            ->leftJoin('delivery_bags', 'deliveries.id', '=', 'delivery_bags.delivery_id')
            ->where('deliveries.pickup_batch_id', '=', $batch_id)
            ->where('pickup_batches.driver_id', '=', $driver_id)
            ->whereNotNull('delivery_bags.delivery_id')
            ->get();
    }

    public function getDriverCompletedBranchPickups($driver_id, $batch_id, $branch_id)
    {

        return Delivery::select('deliveries.id', 'deliveries.customer_id', 'deliveries.branch_id', 'delivery_bags.bag_id')->with([
            'customer' => function ($query) {
                $query->select('id', 'user_id');
            },
            'customer.user' => function ($query) {
                $query->select('id', 'name');
            },
            'branch' => function ($query) {
                $query->select('id', 'name');
            },

        ])
            ->join('pickup_batches', 'deliveries.pickup_batch_id', '=', 'pickup_batches.id')
            ->leftJoin('delivery_bags', 'deliveries.id', '=', 'delivery_bags.delivery_id')
            ->where('deliveries.pickup_batch_id', '=', $batch_id)
            ->where('pickup_batches.driver_id', '=', $driver_id)
            ->where('deliveries.branch_id', '=', $branch_id)
            ->whereNotNull('delivery_bags.delivery_id')
            ->get();
    }
}
