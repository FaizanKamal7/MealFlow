<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\Delivery;
use Modules\DeliveryService\Interfaces\DeliveryInterface;

class DeliveryRepository implements DeliveryInterface
{
    public function create($data)
    {
        return Delivery::create($data);
    }
}
