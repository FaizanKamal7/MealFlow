<?php

namespace Modules\DeliveryService\Interfaces;

interface EmptyBagCollectionBatchInterface
{
    public function updateBagCollectionBatch($batch_id, $data);
    public function createEmptyBagCollectionBatch($driver_id);
    public function getActiveDeliveryBatchByDriver($driver_id);
}
