<?php

namespace App\Enum;


enum MealPlanStatusEnum: string
{
    case FROZEN = 'frozen';
    case ACTIVE = 'active';
    case ENDED = 'ended';
}
