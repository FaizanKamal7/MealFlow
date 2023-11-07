<?php

namespace App\Enum;


class BusinessStatusEnum
{
    case NEW_REQUEST = 'new_request';
    case APPROVED = 'approved';
    case CANCELED = 'canceled';
    case REQUIRE_UPDATE = 'require_update';

}
