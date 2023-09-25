<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryInterface
{
    public function create($data);
    public function get();
    public function getDeliveriesByStatus($status);
    public function AssignDeliveryBtach($batch_id,$deliveries);
}
