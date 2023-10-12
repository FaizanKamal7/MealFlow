<?php

namespace Modules\DeliveryService\Interfaces;

interface EmptyBagCollectionInterface
{
    public function createBagCollection($data);
    public function updateBagsTimelineOnDeliveryBatchCompletion($delivery_ids, $vehicle_id);
}
