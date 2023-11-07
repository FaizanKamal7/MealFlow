<?php

namespace Modules\DeliveryService\Repositories;

use App\Http\Helper\Helper;
use Modules\DeliveryService\Entities\MealPlan;
use Modules\DeliveryService\Interfaces\MealPlanInterface;

class MealPlanRepository implements MealPlanInterface
{

    public function create($data)
    {
        return MealPlan::create($data);
    }

    public function getCustomerMealPlans($customer_id)
    {
        return MealPlan::where("customer_id", $customer_id)->get();
    }
}
