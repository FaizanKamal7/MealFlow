<?php

namespace App\Enum;


enum RoleNamesEnum: string

{
    case BUSINESS_ADMIN = 'Business Admin';
    case CUSTOMER = 'Customer';
    case CUSTOMER_SUPPORT_EMPLOYEE = 'Customer Support Employee';
}
