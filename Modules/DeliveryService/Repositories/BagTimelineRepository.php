<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\BagStatus;
use Modules\DeliveryService\Entities\BagTimeline;
use Modules\DeliveryService\Entities\DeliveryBag;
use Modules\DeliveryService\Interfaces\BagStatusInterface;
use Modules\DeliveryService\Interfaces\BagTimelineInterface;

class BagTimelineRepository implements BagTimelineInterface
{
    public function getLastBagWithStatus($bag_id, $status)
    {
        return BagTimeline::where('bag_id', $bag_id)->where('status', $status)->latest()->first();
    }
}
