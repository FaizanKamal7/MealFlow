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

    public function createVehicleType($name,$capacity,$icon,$activeStatus)
    {
        $vehicle_type = VehicleType::create([
            "name"=>$name,
            'capacity'=>$capacity,
            'icon'=>$icon,
            'active_status'=>$activeStatus,
        ]);
        
        $vehicle_type->save();
        return $vehicle_type;
        
    }
    
    /** 
     * @param $id 
     * @param $name 
     * @param $capacity
     * @param $is_Active
    */
    public function updateVehicleType($id, $name,$capacity,$icon,$activeStatus){
        $vehicle_type = VehicleType::find($id);

        $vehicle_type->name = $name;
        $vehicle_type->capacity = $capacity;
        $vehicle_type->icon = $icon;
        $vehicle_type->active_status = $activeStatus;

        $vehicle_type->save();
        return $vehicle_type;

    }
    public function deleteVehicleType($id){
        $vehicle_type =VehicleType::find($id);
       return $vehicle_type->delete();
    }
    public function getVehicleTypes(){
        return VehicleType::all();
    }
    public function getActiveVehicleTypes()
    {
        return VehicleType::where('active_status', true)->get();
    }
    public function isVehicleTypeExists($name){
        return VehicleType::whereRaw('LOWER(name) = ?', [strtolower($name)])
                            ->exists();
    }
}