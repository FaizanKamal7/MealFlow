<?php

namespace Modules\BusinessService\Http\Livewire;

use Livewire\Component;

class DeliverySlotPricingComponent extends Component
{
    public $cities_delivery_slots;
    public $business_id;
    public $cities;



    public function render()
    {
        return view('businessservice::livewire.delivery-slot-pricing-component');
    }
}
