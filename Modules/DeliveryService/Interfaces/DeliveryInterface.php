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
    public function getDeliveriesByIds(array $deliveryIds);
    public function getDriverPickupAssignedDeliveries($start_date, $end_date, $batch_id);
    public function getDriverPendingPickups($driver_id, $batch_id);
    public function getDriverCompletedPickups($driver_id, $batch_id);
}
