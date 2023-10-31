<?php

namespace App\Enum;


enum AddressStatusEnum: string
{
    case NO_COORDINATES = 'no_coordinates';
    case COORDINATES_MANUAL_APPORVAL_REQUIRED = 'coordinates_manual_approval_required';
    case COORDINATES_VERIFIED = 'coordinates_verified';
}
