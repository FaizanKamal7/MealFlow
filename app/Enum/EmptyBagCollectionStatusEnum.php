<?php

namespace App\Enum;

enum EmptyBagCollectionStatusEnum: string
{
    case UNASSIGNED = 'unassigned';
    case ASSIGNED = 'assigned';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
    case DELAYED = 'delayed';
}
