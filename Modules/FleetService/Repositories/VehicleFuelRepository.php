<?php
namespace Modules\FleetService\Repositories;

use Modules\FleetService\Entities\VehicleFuel;
use Modules\FleetService\Interfaces\VehicleFuelInterface;

class VehicleFuelRepository implements VehicleFuelInterface{
    

    public function createVehicleFuel($data){
      return VehicleFuel::create($data);
    }
    public function getFuelList(){
        return VehicleFuel::with('vehicle','employee')->get();
    }

}