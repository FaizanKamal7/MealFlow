<?php

namespace App\Enum;


enum DeliveryBatchStatusEnum: string
{
    case ASSIGNED = 'assigned';
    case STARTED = 'started';
    case ENDED = 'ended';
}
