<?php
namespace Modules\FleetService\Interfaces;

interface VehicleLogInterface {
    public function createVehicleLog($vehileID,$driveID,$checkInTime,$checkOutTime,$deviceDetails,$checkedOutUser);
    public function getVehicleLogs($vehicleID,$start_date,$end_date);
    

    
}
