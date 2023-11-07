<?php

namespace App\Enum;


class BagStatusEnum
{
    const NEUTRAL = 'neutral'; // Newly uploaded bag     
    const ATTACHED_TO_DELIVERY = 'attached_to_delivery'; // When driver scan both QR's on bag  
    const RECEIVED_IN_WAREHOUSE_WITH_DELIVERY = 'received_in_warehouse_with_delivery'; // When driver complete all the pickups
    // const PICKED_FROM_WAREHOUSE = 'picked_from_warehouse';        // Not certain how to do that
    const DELIVERED = 'delivered'; // When driver deliver delivery to customer    
    const COLLECTED_FROM_CUSTOMER = 'collected_from_customer'; // When driver collect empty bag from cllustomer
    const RECEIVED_EMPTY_IN_WAREHOUSE = 'received_empty_in_warehouse'; // When driver collect empty bag from cllustomer

}
