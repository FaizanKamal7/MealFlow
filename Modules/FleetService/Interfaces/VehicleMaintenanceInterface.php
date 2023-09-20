<?php
namespace Modules\FleetService\Interfaces;

interface VehicleMaintenanceInterface {
    public function createVehicleMaintenance($data);
    public function getVehiclesMaintenances();
}
