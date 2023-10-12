<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\DeliveryTimeline;
use Modules\DeliveryService\Interfaces\DeliveryTimelineInterface;

class DeliveryTimelineRepository implements DeliveryTimelineInterface
{

    public function get()
    {
        return DeliveryTimeline::get();
    }

    public function getDeliveryTimeline($delivery_id)
    {
        return  DeliveryTimeline::where('delivery_id', $delivery_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
