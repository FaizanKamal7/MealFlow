<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BatchProgress extends Component
{
    public $batch;

    public function render()
    {
        return view('deliveryservice::livewire.batch-progress');
    }
}
