<?php
namespace Modules\FleetService\Interfaces;

interface VehicleTypeInterface {
    public function createVehicleType($name,$capacity,$activeStatus);
    public function updateVehicleType($id,$name,$capacity,$activeStatus);
    public function deleteVehicleType($id);
    public function getVehicleTypes();
    public function getActiveVehicleTypes();
    public function isVehicleTypeExists($name);
}