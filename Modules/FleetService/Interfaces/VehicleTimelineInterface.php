<?php
namespace Modules\FleetService\Interfaces;

interface VehicleTimelineInterface {
    public function createVehicleTimeline($vehileID,$driveID,$checkInTime,$checkOutTime,$deviceDetails,$checkedOutUser);

    public function getallVehicleTimeline();
    public function updateVehicleTimeline($id,$checkOutTime,$deviceDetails,$checkedOutUser);
    public function getVehicleTimeline($vehicleID,$start_date,$end_date);
    

    
}
