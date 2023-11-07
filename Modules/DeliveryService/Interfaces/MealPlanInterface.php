<?php

namespace Modules\DeliveryService\Interfaces;

interface MealPlanInterface
{
    public function create($data);
    public function getCustomerMealPlans($customer_id);
}
