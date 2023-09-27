<?php

namespace Modules\BusinessService\Http\Livewire;

use Livewire\Component;
use Modules\BusinessService\Entities\RangePricing;

class RangePricingComponent extends Component
{

    public $available_base_range_pricings;
    public $cities;
    public $business_id;

    public function render()
    {
        return view('businessservice::livewire.range-pricing-component');
    }
}
