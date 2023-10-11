<?php

namespace App\Enum;


enum ServiceTypeEnum: string
{
    case DELIVERY = 'delivery';
    case BAG_COLLECTION = 'bag_collection';
    case CASH_COLLECTION = 'cash_collection';
}
