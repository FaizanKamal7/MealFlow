<?php

namespace Modules\DeliveryService\Repositories;

use App\Enum\BagStatusEnum;
use App\Enum\EmptyBagCollectionStatusEnum;
use App\Http\Helper\Helper;
use Modules\DeliveryService\Entities\BagStatus;
use Modules\DeliveryService\Entities\EmptyBagCollection;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;

class EmptyBagCollectionRepository implements EmptyBagCollectionInterface
{
    public function createBagCollection($data)
    {
        return EmptyBagCollection::create($data);
    }

    public function updateBagsTimelineOnDeliveryBatchCompletion($delivery_ids, $vehicle_id)
    {
        $helper = new Helper();
        EmptyBagCollection::where('status', EmptyBagCollectionStatusEnum::COMPLETED->value)
            ->whereIn('delivery_id', $delivery_ids)
            ->get()->map(function ($emptyBagCollection) use ($helper, $vehicle_id) {
                $helper->bagTimeline(
                    $emptyBagCollection->bag_id,
                    $emptyBagCollection->delivery_id,
                    BagStatusEnum::RECEIVED_EMPTY_IN_WAREHOUSE->value,
                    $emptyBagCollection->empty_bag_collection_batch_id ? $emptyBagCollection->deliveryBatch->driver_id : $emptyBagCollection->delivery->deliveryBatch->driver_id,
                    $vehicle_id,
                    "Delivery Batch completed. Empty Bag is headed towards warehouse",
                );
            });
    }
}
