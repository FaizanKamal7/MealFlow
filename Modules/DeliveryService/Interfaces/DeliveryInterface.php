<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryInterface
{
    public function create($data);
    public function updateDelivery($delivery_id, $data);
    public function get();
    public function getDeliveriesByStatus($status);
    public function assignDeliveryBatch($batch_id, $deliveries);
    public function updateDeliveryQR($delivery_id, $data);
}
