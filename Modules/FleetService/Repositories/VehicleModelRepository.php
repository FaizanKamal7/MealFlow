<?php
namespace Modules\FleetService\Repositories;
use Modules\FleetService\Entities\VehicleModel;
use Modules\FleetService\Interfaces\VehicleModelInterface;

class VehicleModelRepository implements  VehicleModelInterface
{
    /**
     * @param $make
     * @param $model
     * @param $is_active
     */
    public function createVehicleModel($make,$model,$is_active){

    }
    public function getVehicleMakes(){
        return VehicleModel::select('make')->distinct()->get();
    }
    public function getActiveVehicleMakes(){
        return VehicleModel::where('is_active', true)->distinct('make')->pluck('make');
    }
    public function getActiveMakeModels($make)
    {
        return VehicleModel::where('is_active', true)
        ->where('make', $make)->get();
    }
    
}