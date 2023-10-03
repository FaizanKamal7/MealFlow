<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\BagStatus;
use Modules\DeliveryService\Interfaces\BagStatusInterface;



class BagStatusRepository implements BagStatusInterface
{
    public function getStatus($name)
    {
        return BagStatus::where("name", 'LIKE', '%' . $name . '%')->first();
    }
}
