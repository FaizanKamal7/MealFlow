<?php

namespace App\Enum;


// class MealPlanStatusEnum
enum MealPlanStatusEnum: string
{
    case FROZEN = 'frozen';
    case ACTIVE = 'active';
    case ENDED = 'ended';
}
