<?php
namespace Modules\FleetService\Interfaces;

interface VehicleTypeInterface {
    public function createVehicleType($name,$capacity,$icon,$activeStatus);
    public function updateVehicleType($id,$name,$icon,$capacity,$activeStatus);
    public function deleteVehicleType($id);
    public function getVehicleTypes();
    public function getActiveVehicleTypes();
    public function isVehicleTypeExists($name);
}