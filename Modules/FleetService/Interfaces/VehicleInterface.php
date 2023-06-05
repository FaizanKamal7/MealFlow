<?php

namespace Modules\FleetService\Interfaces;

interface VehicleInterface{
    public function createVehicle($registrationNumber,$engineNumber,$chassisNumber,$vehicleModel,$vehicleYear,$vehicleColor,$vehicleStatus,$vehicleTypeId,$vehiclePicture = null,$vehicleMileage,$registrationPicture = null,$registrationIssueDate,$registrationExpiryDate,$insurancePicture= null,$insuranceIssueDate,$insuranceExpiryDate,$municipalityPicture= null,$municipalityIssueDate,$municipalityExpiryDate,$apiUnitId,$qrCode);
    public function getVehicles();
    public function getVehicle($id);

    

    public function getVehicleByCriteria($field,$value);
}