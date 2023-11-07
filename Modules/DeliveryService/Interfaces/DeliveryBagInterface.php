<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryBagInterface
{
    public function create($data);
    public function getDeliveryBagOfDelivery($delivery_id);
    public function isDeliveryReccordExist($delivery_id);
    public function getLastDeliveryBagInfo($bag_id);
    public function getCustomerDeliveryBags($customer_id);
}
