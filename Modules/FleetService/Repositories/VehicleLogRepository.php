<?php
namespace Modules\FleetService\Repositories;

use Modules\FleetService\Entities\VehicleLog;
use Modules\FleetService\Interfaces\VehicleLogInterface;

class VehicleLogRepository implements VehicleLogInterface{
    /**
     * Summary of createVehicleLog
     * @param mixed $vehileID
     * @param mixed $driveID
     * @param mixed $checkInTime
     * @param mixed $checkOutTime
     * @param mixed $deviceDetails
     * @param mixed $checkedOutUser
     * @return mixed
     */
    public function createVehicleLog($vehileID,$driveID,$checkInTime,$checkOutTime,$deviceDetails,$checkedOutUser){

        $vehicle_log = VehicleLog::create([
            'vehicle_id' => $vehileID,
            'drive_id' => $driveID,
            'check_in_time' => $checkInTime,
            'check_out_time' => $checkOutTime,
            'device_details' => $deviceDetails,
            'checked_out_user' => $checkedOutUser,
        ]);

        $vehicle_log->save();
        return $vehicle_log;
    }
    public function getallVehicleLogs(){
        return VehicleLog::all();
    }
    public function updateVehicleLog($id,$checkOutTime,$deviceDetails,$checkedOutUser){
        $vehicle_log = VehicleLog::find($id);

        $vehicle_log->check_out_time = $checkOutTime;
        $vehicle_log->device_detail = $deviceDetails;
        $vehicle_log->checkedOutUser = $checkedOutUser;

        return $vehicle_log->save();
    }
    public function getVehicleLogs($vehicleID,$start_date,$end_date){
        
    }

}
