<?php
namespace Modules\FleetService\Interfaces;

interface VehicleFuelInterface {
    public function createVehicleFuel($data);
    public function getFuelList();
}
