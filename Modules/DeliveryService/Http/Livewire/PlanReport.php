<?php

namespace Modules\DeliveryService\Http\Livewire;

use Livewire\Component;
use Modules\DeliveryService\Entities\MealPlan;

class PlanReport extends Component
{
    public $customer_meal_plans;

    public function render()
    {
        return view('deliveryservice::livewire.plan-report');
    }
}
