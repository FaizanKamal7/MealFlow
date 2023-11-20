<?php

namespace App\Enum;


enum BusinessStatusEnum: string

{
    case NEW_REQUEST = 'new_request';
    case APPROVED = 'approved';
    case CANCELED = 'canceled';
    case REQUIRE_UPDATE = 'require_update';
}
