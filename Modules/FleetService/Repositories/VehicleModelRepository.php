<?php
namespace Modules\FleetService\Repositories;
use Modules\FleetService\Entities\VehicleModel;
use Modules\FleetService\Interfaces\VehicleModelInterface;

class VehicleModelRepository implements  VehicleModelInterface
{
    /**
     * @param $make
     * @param $model
     * @param $active_status
     */
    public function createVehicleModel($make,$model,$active_status){
        $vehicle_model= VehicleModel::create([
            "make"=>$make,
            "model"=>$model,
            "active_status"=>$active_status
        ]);
        $vehicle_model->save();
        return $vehicle_model;

    }
    public function updateVehicleModel($make,$model,$active_status,$id){

        $vehicle_model = VehicleModel::find($id);
        $vehicle_model->make = $make;
        $vehicle_model->model = $model;
        $vehicle_model->active_status = $active_status;
        $vehicle_model->save();

        return $vehicle_model;

    }
    public function getVehicleMakes(){
        // THIS FUNCTION WILL only RETURN ALL MAKES 
        return VehicleModel::select('make')->distinct()->get();
    }
    public function getActiveVehicleMakes(){
        // THIS FUNCTION WILL ONLY RETURN ACTIVE MAKES
        return VehicleModel::where('active_status', true)->distinct('make')->pluck('make');
    }
    public function getActiveMakeModels($make)
    {
        // THIS FUNCTION WILL RETURN ALL MODELS FOR FOR THE GIVEN MAKE
        return VehicleModel::where('active_status', true)
        ->where('make', $make)->get();
    }
    public function isMakeModelExist($make,$model)
    {
        // THIS FUNCTION WILL RETURN TRUE IF THE GIVEN MAKE AND MODEL ALREADY EXIST
        return VehicleModel::where('model', $model)
        ->where('make', $make)->exists();
    }
    public function deleteVehicleModel($id){

        $vehicleModel = VehicleModel::findOrFail($id);
        return $vehicleModel->delete();
    }
    public function getMakeandmodels(){
        return VehicleModel::all();
    }
    
}