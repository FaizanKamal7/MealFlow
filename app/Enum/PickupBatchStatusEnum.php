<?php

namespace App\Enum;


enum PickupBatchStatusEnum: string
{
    case ASSIGNED = 'assigned';
    case STARTED = 'started';
    case ENDED = 'ended';
}
