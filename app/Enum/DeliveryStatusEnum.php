<?php

namespace App\Enum;

class DeliveryStatusEnum 
{
    const UNASSIGNED = 'unassigned';
    const ASSIGNED = 'assigned';
        // case DISPATCHED = 'dispatched';
    const DELIVERED = 'delivered';
    const CANCELED = 'canceled';
    const RESCHEDULED = 'rescheduled';
    const DELAYED = 'delayed';
}
