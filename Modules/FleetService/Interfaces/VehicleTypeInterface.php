<?php
namespace Modules\FleetService\Interfaces;

interface VehicleTypeInterface {
    public function createVehicleType($name,$capicity,$activeStatus);
    public function getVehicleTypes();
    public function getActiveVehicleTypes();
}