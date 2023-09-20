<?php

namespace Modules\FleetService\Repositories;
use Modules\FleetService\Entities\VehicleMaintenance;
use Modules\FleetService\Interfaces\VehicleMaintenanceInterface;

class VehicleMaintenanceRepository implements VehicleMaintenanceInterface{
    public function createVehicleMaintenance($data){
            return VehicleMaintenance::create($data);
    }
    public function getVehiclesMaintenances(){
        return VehicleMaintenance::with('vehicle','maintenanceCategory','employee')->get();
    }

}
