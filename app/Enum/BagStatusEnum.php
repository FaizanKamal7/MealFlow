<?php

namespace App\Enum;


enum BagStatusEnum: string
{
    case NEUTRAL = 'neutral';
    case ATTACHED_TO_DELIVERY = 'attached_to_delivery';
    case RECEIVED_IN_WAREHOUSE = 'received_in_warehouse';
    case PICKED_FROM_WAREHOUSE = 'picked_from_warehouse';
    case DELIVERED = 'delivered';
    case COLLECTED_FROM_CUSTOMER = 'collected_from_customer';
}
