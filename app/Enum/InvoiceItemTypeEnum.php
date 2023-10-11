<?php

namespace App\Enum;


enum InvoiceItemTypeEnum: string
{
    case DELIVERY_SLOT_PRICING = 'delivery_slot_pricing';
    case RANGE_PRICING = 'range_pricing';
}
