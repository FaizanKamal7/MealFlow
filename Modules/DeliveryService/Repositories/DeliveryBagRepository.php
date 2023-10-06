<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\BagStatus;
use Modules\DeliveryService\Entities\DeliveryBag;
use Modules\DeliveryService\Interfaces\DeliveryBagInterface;

class DeliveryBagRepository implements DeliveryBagInterface
{

    public function create($data)
    {
        return DeliveryBag::updateOrCreate($data);
    }

    public function isDeliveryReccordExist($delivery_id)
    {
        return DeliveryBag::where('delivery_id', $delivery_id)->exists();
    }
}
