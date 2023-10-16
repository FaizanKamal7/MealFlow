<?php

namespace App\Enum;


enum BatchStatusEnum: string
{
    case ASSIGNED = 'assigned';
    case STARTED = 'started';
    case ENDED = 'ended';
}
