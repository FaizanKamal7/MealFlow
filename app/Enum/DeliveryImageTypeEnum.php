<?php

namespace App\Enum;


enum DeliveryImageTypeEnum: string
{
    case OPEN_BAG_IMG = 'open_bag_img';
    case CLOSE_BAG_IMG = 'close_bag_img';
    case DELIVERED_BAG_IMG = 'delivered_bag_img';
    case DELIVERY_IMG = 'delivery_img';
    case SIGNATURE_IMG = 'signature_img';
    case ADDRESS_IMG = 'address_img';
}
