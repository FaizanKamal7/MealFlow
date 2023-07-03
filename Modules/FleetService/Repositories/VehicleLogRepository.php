<?php
namespace Modules\FleetService\Repository;

use Modules\FleetService\Interfaces\VehicleLogInterface;

class VehicleLogRepository implements VehicleLogInterface{
    public function createVehicleLog($vehileID,$driveID,$checkInTime,$checkOutTime,$deviceDetails,$checkedOutUser){
        
    }
    public function getVehicleLogs($vehicleID,$start_date,$end_date){
        
    }

}
