<?php
namespace Modules\FleetService\Repositories;
use Modules\FleetService\Entities\VehicleType;
use Modules\FleetService\Interfaces\VehicleTypeInterface;


class VehicleTypeRepository implements VehicleTypeInterface
{
    /** 
     * @param $name 
     * @param $capacity
     * @param $is_Active
    */

    public function createVehicleType($name,$capicity,$activeStatus)
    {
        
    }
    public function getVehicleTypes(){
        return VehicleType::all();
    }
    public function getActiveVehicleTypes()
    {
        return VehicleType::where('is_active', true)->get();
    }
}