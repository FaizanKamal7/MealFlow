<?php

namespace Modules\DeliveryService\Interfaces;

interface BagTimelineInterface
{
    public function getLastBagWithStatus($bag_id, $status);
}
