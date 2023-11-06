<?php

namespace App\Enum;


enum UserTypeEnum: string
{
    case BUSINESS_USER = 'business_user';
    case CUSTOMER = 'customer';
    case EMPLOYEE = 'employee';
}
