<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryTimelineInterface
{
    public function get();
    public function getDeliveryTimeline($delivery_id);
}
