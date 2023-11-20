<?php

namespace Modules\DeliveryService\Http\Livewire;

use Livewire\Component;

class MealPlannerForm extends Component
{
    public $starting_date;
    public $expiry_dates;
    public $no_of_days;
    public $included_dates;
    public $customer_addresses;
    public $product_type;
    public $branches;
    public $skip_days;


    function mount(
        $customer_addresses,
        $product_type,
        $branches
    ) {
        $this->customer_addresses = $customer_addresses;
        $this->product_type = $product_type;
        $this->branches = $branches;
    }
    public function render()
    {
        return view('deliveryservice::livewire.meal-planner-form');
    }
}
