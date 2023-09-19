<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\Bag;
use Modules\DeliveryService\Entities\DeliveryType;
use Modules\DeliveryService\Interfaces\BagsInterface;
use Modules\DeliveryService\Interfaces\DeliveryTypeInterface;

class DeliveryTypeRepository implements DeliveryTypeInterface
{

    public function get()
    {
        return DeliveryType::get();
    }

    public function getWhereFirst($where)
    {
        return DeliveryType::where($where)->first();
    }
}
