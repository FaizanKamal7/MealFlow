<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\BagStatus;
use Modules\DeliveryService\Entities\DeliveryBag;
use Modules\DeliveryService\Interfaces\DeliveryBagInterface;

class DeliveryBagRepository implements DeliveryBagInterface
{

    public function create($data)
    {
        return DeliveryBag::create($data);
    }
}
