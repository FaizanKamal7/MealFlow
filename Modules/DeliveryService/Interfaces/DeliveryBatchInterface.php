<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryBatchInterface {
    public function createDeliveryBatch($driver_id);
    public function getActiveDeliveryBatchByDriver($driver_id);
} 