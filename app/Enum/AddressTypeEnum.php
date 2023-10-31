<?php

namespace App\Enum;


enum AddressTypeEnum: string
{
    case DEFAULT = 'default';
    case HOME = 'home';
    case OFFICE = 'office';
    case OTHER = 'other';
}
