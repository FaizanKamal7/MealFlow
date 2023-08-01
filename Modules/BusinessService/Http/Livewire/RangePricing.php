<?php

namespace Modules\BusinessService\Http\Livewire;

use Livewire\Component;

class RangePricing extends Component
{

    public $available_base_range_pricings;
    public $cities;


    public function mount($available_base_range_pricings)
    {
        $this->available_base_range_pricings = $available_base_range_pricings;
    }

    public function render()
    {
        return view('businessservice::livewire.range-pricing');
    }
}
