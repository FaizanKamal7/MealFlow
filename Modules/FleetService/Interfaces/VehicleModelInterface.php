<?php

namespace Modules\FleetService\Interfaces;

interface VehicleModelInterface{
    public function createVehicleModel($make,$model,$is_active);
    public function getVehicleMakes();
    public function getActiveVehicleMakes();
    public function getActiveMakeModels($make);
    
}