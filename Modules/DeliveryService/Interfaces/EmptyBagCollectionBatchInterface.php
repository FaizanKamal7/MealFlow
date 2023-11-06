<?php

namespace Modules\DeliveryService\Interfaces;

interface EmptyBagCollectionBatchInterface
{
    public function getActiveDeliveryBatchByDriver($driver_id);
}
