<?php

namespace App\Enum;


enum BagStatusEnum: string
{
    case NEUTRAL = 'neutral';                                           // Newly uploaded bag     
    case ATTACHED_TO_DELIVERY = 'attached_to_delivery';                 // When driver scan both QR's on bag  
    case RECEIVED_IN_WAREHOUSE_WITH_DELIVERY = 'received_in_warehouse_with_delivery';       // When driver complete all the pickups
    case DISPATCHED_FROM_WAREHOUSE = 'picked_from_warehouse';        // Not certain how to do that
    case DELIVERED = 'delivered';                                       // When driver deliver delivery to customer    
    case COLLECTED_FROM_CUSTOMER = 'collected_from_customer';           // When driver collect empty bag from cllustomer
    case RECEIVED_EMPTY_IN_WAREHOUSE = 'received_empty_in_warehouse';   // When driver collect empty bag from cllustomer

}
