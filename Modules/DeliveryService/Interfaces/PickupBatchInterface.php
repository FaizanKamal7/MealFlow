<?php

namespace Modules\DeliveryService\Interfaces;

interface PickupBatchInterface
{
    public function createPickupBatch($driver_id);
    public function updatePickupBatch($batch_id, $data);
    public function getActivePickupBatchByDriver($driver_id);
    public function getDriverActiveBatchWithDeliveries($driver_id);
}
