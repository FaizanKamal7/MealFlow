<?php

namespace Modules\DeliveryService\Http\Livewire;

use Livewire\Component;

class MealPlannerForm extends Component
{
    public $starting_date;
    public $expiry_dates;
    public $no_of_days;
    public $included_dates;
    public $time_slot;

    public $customer_addresses;



    public function render()
    {
        return view('deliveryservice::livewire.meal-planner-form');

    }
}
