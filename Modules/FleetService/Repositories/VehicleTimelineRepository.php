<?php
namespace Modules\FleetService\Repositories;

use Modules\FleetService\Entities\VehicleTimeline;
use Modules\FleetService\Interfaces\VehicleTimelineInterface;

class VehicleTimelineRepository implements VehicleTimelineInterface{
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
    public function createVehicleTimeline($vehileID,$driveID,$checkInTime,$checkOutTime,$deviceDetails,$checkedOutUser){

        $vehicle_timeline = VehicleTimeline::create([
            'vehicle_id' => $vehileID,
            'drive_id' => $driveID,
            'check_in_time' => $checkInTime,
            'check_out_time' => $checkOutTime,
            'device_details' => $deviceDetails,
            'checked_out_user' => $checkedOutUser,
        ]);

        $vehicle_timeline->save();
        return $vehicle_timeline;
    }
    public function getallVehicleTimeline(){
        return VehicleTimeline::all();
    }
    public function updateVehicleTimeline($id,$checkOutTime,$deviceDetails,$checkedOutUser){
        $vehicle_timeline = VehicleTimeline::find($id);

        $vehicle_timeline->check_out_time = $checkOutTime;
        $vehicle_timeline->device_detail = $deviceDetails;
        $vehicle_timeline->checkedOutUser = $checkedOutUser;

        return $vehicle_timeline->save();
    }
    public function getVehicleTimeline($vehicleID,$start_date,$end_date){
        
    }

}
