<?php

namespace App\Enum;

enum DeliveryStatusEnum: string
{
    case UNASSIGNED = 'unassigned';
    case ASSIGNED = 'assigned';
        // case DISPATCHED = 'dispatched';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';
    case RESCHEDULED = 'rescheduled';
    case DELAYED = 'delayed';
}
