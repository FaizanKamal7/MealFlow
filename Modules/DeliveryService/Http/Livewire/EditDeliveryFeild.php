<?php

namespace Modules\DeliveryService\Http\Livewire;

use Livewire\Component;

class EditDeliveryFeild extends Component
{

    public $entityId;
    public $shortId;
    public $origName;
    public $isName;
    public $newName;
    public $feild = "tmp_f";
    public $model; // Define the $model property here
    public function mount($model, $entity)
    {
        $this->entityId = $entity->id;
        $this->shortId = $entity->id;
        $this->origName = $entity->address;

        $this->init($this->model, $entity); // initialize the component state
    }

    public function save()
    {
        $entity = $this->model::findOrFail($this->entityId);
        $newName = (string)Str::of($this->newName)->trim()->substr(0, 100); // trim whitespace & more than 100 characters
        $newName = $newName === $this->shortId ? null : $newName; // don't save it as operation name it if it's identical to the short_id

        $entity->address = $newName ?? null;
        $entity->save();
        $this->init($this->model, $entity); // re-initialize the component state with fresh data after saving
        $this->dispatchBrowserEvent('notify', Str::studly($this->field) . ' successfully updated!');
    }

    private function init($model, $entity)
    {
        $this->origName = $entity->address ?: $this->shortId;
        $this->newName = $this->origName;
        $this->isName = $entity->address ?? false;
    }

    public function render()
    {
        return view('deliveryservice::livewire.edit-delivery-feild');
    }
}
