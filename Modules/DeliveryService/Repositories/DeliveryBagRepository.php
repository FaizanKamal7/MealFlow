<?php

namespace Modules\DeliveryService\Repositories;

use App\Enum\BagStatusEnum;
use Modules\DeliveryService\Entities\BagStatus;
use Modules\DeliveryService\Entities\Delivery;
use Modules\DeliveryService\Entities\DeliveryBag;
use Modules\DeliveryService\Interfaces\DeliveryBagInterface;

class DeliveryBagRepository implements DeliveryBagInterface
{

    public function create($data)
    {
        return DeliveryBag::updateOrCreate($data);
    }

    public function getDeliveryBag($delivery_id)
    {
        return DeliveryBag::where('delivery_id', $delivery_id)->last();
    }

    public function isDeliveryReccordExist($delivery_id)
    {
        return DeliveryBag::where('delivery_id', $delivery_id)->exists();
    }

    public function getLastDeliveryBagInfo($bag_id)
    {
        return DeliveryBag::where('bag_id', '=', $bag_id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function getCustomerDeliveryBags($customer_id)
    {
        // ---- All deliveries for a specific customer (using 'customer_id'), 
        // ---- where the 'status' in the 'bag_timelines' table is not 'collected_from_customer'.
        $deliveries = Delivery::where('customer_id', $customer_id)
            ->whereDoesntHave('bagTimelines', function ($query) {
                $query->where('status', '=', BagStatusEnum::COLLECTED_FROM_CUSTOMER->value);
            })
            ->orderBy('id', 'desc')
            ->get();

        $delivery_ids = $deliveries->pluck('id'); // Get just the IDs of the deliveries
        return DeliveryBag::with('delivery')->with('bag')->whereIn('delivery_id', $delivery_ids)->get();
    }
}
