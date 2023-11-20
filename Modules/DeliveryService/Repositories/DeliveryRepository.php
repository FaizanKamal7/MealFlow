<?php

namespace Modules\DeliveryService\Repositories;

use App\Enum\DeliveryStatusEnum;
use Illuminate\Support\Facades\DB;
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

    public function getSingleDelivery($id)
    {
        return Delivery::with('deliverySlot', 'customerAddress')->find($id);
    }

    public function getDeliveredCountOfDays($branch_id, $start_date, $end_date)
    {
        return Delivery::where('branch_id', $branch_id)
            ->where('status', 'DELIVERED')
            ->where('delivery_date', '>=', $start_date)->where('delivery_date', '<', $end_date)
            ->count();
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
        Delivery::whereIn('id', $deliveries)->each(function ($delivery) use ($batch_id) {
            $delivery->update([
                'delivery_batch_id' => $batch_id,
                'status' => DeliveryStatusEnum::ASSIGNED->value,
            ]);
        });
        // ---- Below query is fast but avoiding below as it wont triggger laravel event observer 
        // Delivery::whereIn('id', $deliveries)->update([
        //     'delivery_batch_id' => $batch_id,
        //     'status' => DeliveryStatusEnum::ASSIGNED->value,
        // ]);
    }

    public function assignPickupBatch($batch_id, $deliveries)
    {
        // Delivery::whereIn('id', $deliveries)->update([
        //     'pickup_batch_id' => $batch_id,
        // ]);
        Delivery::whereIn('id', $deliveries)->each(function ($delivery) use ($batch_id) {
            $delivery->update([
                'pickup_batch_id' => $batch_id,
            ]);
        });
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

    public function getDeliveriesByMealID($meal_id)
    {
        return Delivery::where('meal_plan_id', $meal_id)->get();
    }


    public function getCompletedPickupDeliveries($start_date, $end_date)
    {
        return Delivery::whereNotNull('pickup_batch_id')->get();
    }

    public function updateDeliveryQR($delivery_id, $data)
    {
        return Delivery::where('id', $delivery_id)->whereNull('qr_code')->update($data);
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

        $deliveries = DB::table('deliveries')
            ->select('deliveries.id', 'deliveries.customer_id', 'deliveries.branch_id', 'deliveries.pickup_batch_id')
            ->join('pickup_batches', 'deliveries.pickup_batch_id', '=', 'pickup_batches.id')
            ->leftJoin('delivery_bags', 'deliveries.id', '=', 'delivery_bags.delivery_id')
            ->where('deliveries.pickup_batch_id', '=', $batch_id)
            ->where('pickup_batches.driver_id', '=', $driver_id)
            ->where('deliveries.branch_id', '=', $branch_id)
            ->whereNull('delivery_bags.delivery_id')
            ->get()
            ->keyBy('id');

        $customerIds = $deliveries->pluck('customer_id');
        $customers = DB::table('customers')
            ->select('id', 'user_id')
            ->whereIn('id', $customerIds)
            ->get()
            ->keyBy('id');

        $userIds = $customers->pluck('user_id');
        $users = DB::table('users')
            ->select('id', 'name')
            ->whereIn('id', $userIds)
            ->get()
            ->keyBy('id');

        $branchIds = $deliveries->pluck('branch_id');
        $branches = DB::table('branches')
            ->select('id', 'name')
            ->whereIn('id', $branchIds)
            ->get()
            ->keyBy('id');

        foreach ($deliveries as $delivery) {
            $delivery->customer = $customers[$delivery->customer_id] ?? null;
            if ($delivery->customer) {
                $delivery->customer->user = $users[$delivery->customer->user_id] ?? null;
            }
            $delivery->branch = $branches[$delivery->branch_id] ?? null;
        }
        return $deliveries;
        // return Delivery::select('deliveries.id', 'deliveries.customer_id', 'deliveries.branch_id', 'deliveries.pickup_batch_id')->with([
        //     'customer' => function ($query) {
        //         $query->select('id', 'user_id');
        //     },
        //     'customer.user' => function ($query) {
        //         $query->select('id', 'name');
        //     },
        //     'branch' => function ($query) {
        //         $query->select('id', 'name');
        //     },

        // ])
        //     ->join('pickup_batches', 'deliveries.pickup_batch_id', '=', 'pickup_batches.id')
        //     ->leftJoin('delivery_bags', 'deliveries.id', '=', 'delivery_bags.delivery_id')
        //     ->where('deliveries.pickup_batch_id', '=', $batch_id)
        //     ->where('pickup_batches.driver_id', '=', $driver_id)
        //     ->where('deliveries.branch_id', '=', $branch_id)
        //     ->whereNull('delivery_bags.delivery_id')
        //     ->get();
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


    public function getAllBatchDeliveries($delivery_batch_id)
    {
        return Delivery::where('delivery_batch_id', $delivery_batch_id)->get();
    }
}
