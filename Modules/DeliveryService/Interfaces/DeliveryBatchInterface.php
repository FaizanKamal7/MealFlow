<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryBatchInterface {
    public function createDeliveryBatch($driver_id);
    public function updateDeliveryBatch($batch_id,$data);
    public function getActiveDeliveryBatchByDriver($driver_id);
    public function getDriverActiveBatchWithDeliveries($driver_id);
} 