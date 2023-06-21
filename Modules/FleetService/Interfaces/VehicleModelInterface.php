<?php

namespace Modules\FleetService\Interfaces;

interface VehicleModelInterface{
    public function createVehicleModel($make,$model,$active_status);
    public function updateVehicleModel($make,$model,$active_status,$id);
    public function getVehicleMakes();
    public function getMakeandmodels();
    public function getActiveVehicleMakes();
    public function getActiveMakeModels($make);
    public function isMakeModelExist($make,$model);
    public function deleteVehicleModel($id);

    
}