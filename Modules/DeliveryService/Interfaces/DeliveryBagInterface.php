<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryBagInterface
{
    public function create($data);
    public function isDeliveryReccordExist($delivery_id);
    public function getLastDeliveryBagInfo($where);
}
