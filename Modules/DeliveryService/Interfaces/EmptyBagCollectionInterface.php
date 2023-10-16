<?php

namespace Modules\DeliveryService\Interfaces;

interface EmptyBagCollectionInterface
{
    public function getBagCollection();
    public function getBagCollectionWhere($where);
    public function createBagCollection($data);
    public function updateBagsTimelineOnDeliveryBatchCompletion($delivery_ids, $vehicle_id);
}
